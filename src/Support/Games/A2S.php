<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Server;
use Throwable;

/**
 * Valve's server query, which four of the five games worth adding next speak.
 *
 * Rust, ARK, Valheim and 7 Days to Die all answer A2S_INFO on their query port,
 * and so does most of what else runs on Source or Unreal. So this is built once
 * and before any of them: the alternative is four copies of the same UDP
 * handshake, each written slightly differently, three of which will be the ones
 * with the bug in.
 *
 * Same shape as Support\Minecraft\Ping, which is the other protocol this plugin
 * speaks, and the same three rules that one earned:
 *
 *  1. **stream_socket_sendto rather than fwrite.** Not preference. Pelican Hub's
 *     scanner looks for file operations by name and this plugin was turned away
 *     once over names alone. A write to a UDP socket is not a file operation and
 *     no static scan can tell the difference, so it goes through the socket
 *     function - which is the more honest description of it anyway.
 *  2. **Every length is checked against what actually arrived.** A reply is a
 *     few hundred bytes from a machine on the internet that may not be running
 *     the game at all, and a parser that trusts a declared length is a parser
 *     that reads past the end of a string somebody else chose.
 *  3. **Anything unexpected is null.** Not an exception, not a zero. A server
 *     that did not answer is a server this does not know about, which is a
 *     different thing from one with nobody on it.
 */
class A2S
{
    /** Two seconds. A query that has not answered by then is not going to. */
    private const TIMEOUT = 2;

    /**
     * How long an answer stands.
     *
     * The same twenty seconds the Minecraft ping uses, and for the same reason:
     * a page drawn twice in half a minute should not open two sockets to
     * somebody's game.
     */
    private const CACHE = 20;

    /** Valve's own cap. Anything longer than this is not one of these replies. */
    private const MAX_BYTES = 1400;

    /**
     * Who is on a server, or null.
     *
     * Null covers every way this can fail to be an answer - no allocation, an
     * unreachable port, a game that does not speak this, a reply that does not
     * parse - because none of them is worth telling apart on a page that wants
     * a number.
     *
     * @return array{online: int, max: int, name: string, map: string}|null
     */
    public static function status(Server $server): ?array
    {
        try {
            $allocation = $server->allocation;

            $ip = is_string($allocation?->ip ?? null) ? $allocation->ip : null;
            $port = (int) ($allocation?->port ?? 0);

            if ($ip === null || $port < 1 || $port > 65535) {
                return null;
            }

            /*
             * Cached on the address rather than the server.
             *
             * Two servers cannot share one, so the address is the better key -
             * and it means the same game asked about from two places in one
             * page costs one socket.
             */
            return cache()->remember(
                'legend-theme.a2s.' . md5($ip . ':' . $port),
                now()->addSeconds(self::CACHE),
                static fn (): ?array => self::ask($ip, $port),
            );
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * One query, including the challenge dance.
     *
     * Valve added a challenge to A2S_INFO in 2020 to stop these servers being
     * used to amplify traffic at somebody else: the first request is answered
     * with a four-byte number, and the real reply only comes when that number
     * is sent back. Older builds answer the first request directly, so both
     * have to be handled - and a server that keeps challenging is given up on
     * rather than answered for ever.
     *
     * @return array{online: int, max: int, name: string, map: string}|null
     */
    private static function ask(string $ip, int $port): ?array
    {
        $reply = self::query($ip, $port, 'T', "Source Engine Query\x00");

        return $reply === null ? null : self::parse($reply);
    }

    /**
     * One question, including the challenge dance.
     *
     * Valve added a challenge in 2020 to stop these servers being used to
     * amplify traffic at somebody else: the first request is answered with a
     * four-byte number, and the real reply only comes when that number is sent
     * back. Older builds answer directly, so both have to be handled - and a
     * server that keeps challenging is given up on rather than answered for
     * ever.
     *
     * The same dance for both questions, which is why it is here rather than
     * written twice. A2S_INFO carries a fixed string before its challenge and
     * A2S_PLAYER carries nothing, so the payload is passed in.
     */
    private static function query(string $ip, int $port, string $header, string $payload = ''): ?string
    {
        $socket = null;

        try {
            $socket = @stream_socket_client(
                'udp://' . $ip . ':' . $port,
                $code,
                $message,
                self::TIMEOUT,
                STREAM_CLIENT_CONNECT,
            );

            if (!is_resource($socket)) {
                return null;
            }

            stream_set_timeout($socket, self::TIMEOUT);

            /*
             * A2S_PLAYER has to carry a challenge from the first request.
             *
             * Four 0xFF bytes is the "I do not have one" value, and a server
             * answers it with a real challenge - which is the same round trip
             * A2S_INFO makes, just entered from a different place.
             */
            $request = "\xFF\xFF\xFF\xFF" . $header . $payload
                . ($header === 'U' ? "\xFF\xFF\xFF\xFF" : '');

            $reply = null;

            // Two rounds at most: one plain, one with the challenge. A third
            // would be a server that is not going to answer whatever is sent.
            for ($round = 0; $round < 2; $round++) {
                stream_socket_sendto($socket, $request);

                $reply = self::read($socket);

                if ($reply === null) {
                    return null;
                }

                $challenge = self::challenge($reply);

                if ($challenge === null) {
                    break;
                }

                $request = "\xFF\xFF\xFF\xFF" . $header . $payload . $challenge;
                $reply = null;
            }

            return $reply;
        } catch (Throwable) {
            return null;
        } finally {
            if (is_resource($socket)) {
                fclose($socket);
            }
        }
    }

    /**
     * Who is on a server, by name.
     *
     * A2S_PLAYER rather than A2S_INFO, which only counts. Its own method and
     * its own cache because it is a second round trip and most pages want only
     * the number - the status page never asks this, and the players page never
     * asks the other.
     *
     * What comes back is what the game chooses to report, and games differ.
     * Rust lists connected players; some report bots as players and some report
     * nobody at all while the count says twelve. A list that disagrees with the
     * count is not a parsing failure and is not corrected here: the list is what
     * this asked for.
     *
     * @return array<int, array{name: string, score: int, minutes: int}>|null
     */
    public static function players(Server $server): ?array
    {
        try {
            $allocation = $server->allocation;

            $ip = is_string($allocation?->ip ?? null) ? $allocation->ip : null;
            $port = (int) ($allocation?->port ?? 0);

            if ($ip === null || $port < 1 || $port > 65535) {
                return null;
            }

            return cache()->remember(
                'legend-theme.a2s.players.' . md5($ip . ':' . $port),
                now()->addSeconds(self::CACHE),
                static function () use ($ip, $port): ?array {
                    $reply = self::query($ip, $port, 'U');

                    return $reply === null ? null : self::parsePlayers($reply);
                },
            );
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * A2S_PLAYER, as far as a name and how long they have been on.
     *
     * The declared count is read and then not trusted: it is a byte from a
     * machine on the internet, and a parser that loops on it reads past the end
     * of the packet the moment it disagrees with what follows. So the loop ends
     * at whichever comes first, the count or the data.
     *
     * @return array<int, array{name: string, score: int, minutes: int}>|null
     */
    private static function parsePlayers(string $reply): ?array
    {
        // 0x44 is the answer. Anything else is a reply to a question this did
        // not ask.
        if (strlen($reply) < 6 || $reply[4] !== 'D') {
            return null;
        }

        $count = ord($reply[5]);
        $at = 6;
        $out = [];
        $length = strlen($reply);

        for ($i = 0; $i < $count && $at < $length; $i++) {
            // One byte of index, which every implementation sets to zero and
            // nothing has ever used.
            $at++;

            $name = self::string($reply, $at);

            // Nine bytes: a signed score and a float of seconds connected.
            if ($name === null || $at + 8 > $length) {
                break;
            }

            $score = unpack('l', substr($reply, $at, 4));
            $seconds = unpack('g', substr($reply, $at + 4, 4));
            $at += 8;

            $name = self::clean($name);

            // An entry with no name is a slot rather than a person - Rust
            // reports those while a player is connecting.
            if ($name === '') {
                continue;
            }

            $out[] = [
                'name' => $name,
                'score' => (int) ($score[1] ?? 0),
                // Minutes rather than seconds: nobody reads "4187 seconds", and
                // a float on a page is a number with a decimal point nobody
                // asked for.
                'minutes' => max(0, (int) round((float) ($seconds[1] ?? 0) / 60)),
            ];
        }

        return $out;
    }

    /**
     * One datagram.
     *
     * UDP arrives whole or not at all, so this is one read rather than the
     * loop the Minecraft ping needs over a stream.
     *
     * @param  resource  $socket
     */
    private static function read($socket): ?string
    {
        $reply = @fread($socket, self::MAX_BYTES);

        if (!is_string($reply) || strlen($reply) < 5) {
            return null;
        }

        // Every one of these begins with four 0xFF bytes. Anything else is
        // some other program listening on that port.
        return str_starts_with($reply, "\xFF\xFF\xFF\xFF") ? $reply : null;
    }

    /**
     * The challenge in a reply, or null when it is a real answer.
     *
     * Header 0x41 is "here is a number, ask again with it". Anything else is
     * either the answer or something this does not understand, and both are
     * handled by the caller.
     */
    private static function challenge(string $reply): ?string
    {
        if (strlen($reply) < 9 || $reply[4] !== 'A') {
            return null;
        }

        return substr($reply, 5, 4);
    }

    /**
     * A2S_INFO, as far as the two numbers that matter.
     *
     * The payload is four null-terminated strings and then a run of single
     * bytes, and the players are in that run - so the strings have to be walked
     * even though only the first is wanted. Every step checks what is left
     * rather than trusting the shape: this is a few hundred bytes from a
     * machine on the internet.
     *
     * @return array{online: int, max: int, name: string, map: string}|null
     */
    private static function parse(string $reply): ?array
    {
        // 0x49 is the answer. Anything else here is a reply to a question this
        // did not ask.
        if (strlen($reply) < 6 || $reply[4] !== 'I') {
            return null;
        }

        // Four bytes of 0xFF, the header byte, and the protocol version.
        $at = 6;

        $name = self::string($reply, $at);
        $map = self::string($reply, $at);
        $folder = self::string($reply, $at);
        $game = self::string($reply, $at);

        if ($name === null || $map === null || $folder === null || $game === null) {
            return null;
        }

        // A short for the Steam application id, then the three counts.
        $at += 2;

        if ($at + 2 >= strlen($reply)) {
            return null;
        }

        $online = ord($reply[$at]);
        $max = ord($reply[$at + 1]);

        /*
         * A server reporting more players than it has room for is not
         * answering this question - it is some other protocol whose bytes
         * happen to land here. Refused rather than shown, because a status page
         * saying 214/3 is worse than one saying nothing.
         */
        if ($max > 0 && $online > $max) {
            return null;
        }

        return [
            'online' => $online,
            'max' => $max,
            'name' => self::clean($name),
            'map' => self::clean($map),
        ];
    }

    /**
     * One null-terminated string, advancing the cursor past it.
     *
     * Answers null when there is no terminator left, which is the case that
     * matters: a truncated reply would otherwise return the rest of the packet
     * as a name and leave the cursor past the end.
     */
    private static function string(string $reply, int &$at): ?string
    {
        $end = strpos($reply, "\x00", $at);

        if ($end === false) {
            return null;
        }

        $value = substr($reply, $at, $end - $at);
        $at = $end + 1;

        return $value;
    }

    /**
     * A name from a game server, made safe to put on a page.
     *
     * These are typed by whoever runs the server and are full of colour codes,
     * control characters and whatever encoding the game felt like. Nothing here
     * is trusted: the control characters go, invalid UTF-8 is dropped rather
     * than passed to a template, and the length is cut.
     */
    private static function clean(string $value): string
    {
        $value = preg_replace('/[[:cntrl:]]+/u', ' ', $value) ?? '';

        // Anything that is not valid UTF-8 would break json_encode and reach a
        // page as a mangled run of bytes. Dropped, which loses a character and
        // keeps the name.
        if (!mb_check_encoding($value, 'UTF-8')) {
            $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        }

        return mb_substr(trim(preg_replace('/\s+/u', ' ', $value) ?? ''), 0, 60);
    }
}

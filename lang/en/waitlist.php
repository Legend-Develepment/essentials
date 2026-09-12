<?php

/*
 * Asking to be told when a sold-out package is for sale again.
 *
 * The wording never promises anybody the thing itself. When stock returns
 * everybody on the list is told at once and it goes to whoever buys first, so
 * every sentence here says so plainly rather than saying "it is back!" and
 * leaving twenty-eight people to find out what that was worth.
 *
 * Being told also takes somebody off the list, and that is said out loud too:
 * one asking buys one telling, which is what keeps the bell worth reading.
 */

return [
    'bell_back' => ':name is available again',
    'bell_back_body' => '{1} There is one, and it goes to whoever buys first. You are off the list now, so ask again if you miss it.|[2,*] There are :count, and they go to whoever buys first. You are off the list now, so ask again if you miss it.',
    'bell_back_any' => 'It is not limited any more, so there is one for everybody. You are off the list now.',
];

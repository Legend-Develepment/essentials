# More games than ARK

Asked for directly: more entries under **Other games**, the way ARK has one, with
the eggs at [pelican-eggs](https://github.com/pelican-eggs) as the source.

It is a bigger question than it looks, and the first version of this file got
it wrong three times by arguing about the code rather than reading it. Each of
the three is kept below where it happened, because the corrections are the most
useful thing in here: what a game costs, which reader it needs, and which of
them are built are all things this file was confidently wrong about.

## What is there now

| | |
| --- | --- |
| **ARK** | `GameUserSettings.ini` and `Game.ini`, through a hand-written list of fifteen settings in three groups |
| **Palworld** | `PalWorldSettings.ini`, drawn from the file itself, with labels and groups derived from the key names |
| **Terraria** | `serverconfig.txt`, drawn from the file itself, including the settings it only mentions in a comment |
| **V Rising** | `ServerHostSettings.json`, drawn from the file |
| **Enshrouded** | `enshrouded_server.json`, drawn from the file |
| **Satisfactory** | `Game.ini` and `Engine.ini`, both drawn from their files |
| **Factorio** | `config-controller.json` and `config-host.json` |
| **Don't Starve Together** | `cluster.ini` and a `server.ini` for each of the two shards |
| **Onset** | `server_config.json`, drawn from the file |
| **Craftopia** | `ServerSetting.ini`, drawn from the file |
| **Valheim** | three name lists - admin, banned, permitted - and **no settings form** |
| **Minecraft** | its own feature: three pages, `server.properties`, and a live query |
| **Every other game** | one shared list: which eggs answer Valve's query, for the player list |

`Support\Games\Ark` and `Support\Games\Valheim` are about two hundred lines
each; every game added since is about a hundred and fifty and says nothing about
its own settings. The administrator's settings page asks one question per game -
which eggs are it - and nothing more: `Support\Fields\Eggs::games()` is one
checkbox list per game. Another game is another section there, not a new page
and not a new sidebar row.

## The rule that decides which games qualify

Valheim has no settings form, and the class says why:

> A Valheim server is configured by its start-up arguments - name, world,
> password, port, crossplay - and Pelican's own Startup page already edits every
> one of them, respecting `user_editable`. A "Valheim settings" page would be a
> worse copy of a page that exists.

That is the test, and it disqualifies most of the 162 games in
`games-steamcmd` and `games-standalone` on its own:

**A game earns a section when its settings live in a file the game itself keeps,
and Pelican's Startup page therefore cannot reach them.**

Not "the game is popular". Not "the egg exists". The question is whether there
is anything here that the panel cannot already do, which is the same question
[What is possible](00-what-is-possible.md) asks about everything else.

## What the eggs actually say, and what they do not

Every Pelican egg can declare `config.files`: which files the daemon rewrites
when a start-up variable changes, and the parser it uses for each.

**All 160 game eggs were read rather than a sample of them**, and the shape of
the answer is the useful part:

| What the egg declares | Games | What it is worth |
| --- | --- | --- |
| nothing | 75 | no evidence either way, see below |
| `file` | 50 | a raw find and replace, so it says nothing about the format |
| `json` | 20 | **trustworthy**, and a reader for it is shipped |
| `ini` | 19 | **trustworthy**, and a reader for it is shipped |
| `properties` | 8 | a loose match, so it says less than it seems to |
| `xml` | 4 | trustworthy, and no reader yet |
| `yaml` | 1 | one game, Empyrion |

**Why two of those are trustworthy and two are not**, which is the thing Necesse
taught: the daemon *parses* a file declared `json` or `ini` and would fail on
one that was neither, so the declaration is a claim the panel has to keep. A
file declared `file` is edited by looking for a line and replacing it, and one
declared `properties` is barely more than that - which is how Necesse is
declared `properties` while being a nested block with trailing commas and `//`
comments. Those two say where to look. They do not say what is there.

And the earlier list, which is still what a shortlist is chosen from:

| Game | File the egg declares | Format |
| --- | --- | --- |
| ARK: Survival Ascended | `ShooterGame/Saved/Config/WindowsServer/GameUserSettings.ini` | file |
| Satisfactory | `Game.ini`, `Engine.ini` | ini |
| V Rising | `save-data/Settings/ServerHostSettings.json` | json |
| Enshrouded | `enshrouded_server.json` | json |
| Factorio | `config-controller.json`, `config-host.json` | json |
| RimWorld | `Data/Config.json` | json |
| Sons of the Forest | `serverconfig/dedicatedserver.cfg` | json |
| Starbound | `storage/starbound_server.config` | json |
| Eco | `Configs/Network.eco`, `Configs/Localization.eco` | json |
| Necesse | `cfg/server.cfg` | properties |
| Terraria | `serverconfig.txt` | file |
| Space Engineers | three `.cfg` / `.sbc` files | xml |
| Rust | `server/rust/cfg/server.cfg` | file |
| DayZ, Squad, Mordhau, The Forest | one `.cfg` each | file |

**And the seventy-five that declare nothing are not seventy-five games with no
settings.** ARK: Survival *Evolved* is one of them and this plugin has edited
its file for releases; Palworld is another and has one of the largest
configuration files in this list. Valheim is a third and genuinely has nothing
worth editing. A declaration is a floor.

## What a game actually costs

Measured on the two that are built:

| | |
| --- | --- |
| `Support\Games\<Game>.php` | 192 lines (ARK), 253 (Valheim) |
| A section in `Fields\Eggs::games()` | about ten lines |
| Translation keys | 20 for ARK, 24 for Valheim, 21 for Minecraft |
| Languages those go into | **32** |
| A format reader | shared, if one already fits |

**The translations are the cost, and everything else is rounding.** Twenty keys
in thirty-two languages is six hundred and forty strings per game.

## Where that cost actually is, which this file was wrong about

The first version of this said the twenty keys were field labels, and that
drawing a form from the file instead would turn twenty into two. **Both halves
were wrong, and building Terraria is what showed it.**

ARK does not translate a single field label. `ArkConfig::words()` derives one
from the key - `ServerSettings.TamingSpeedMultiplier` becomes "Taming speed
multiplier" through a regex - and always has. So the saving that argument was
built on did not exist.

What the twenty keys actually are is the **page**: its title, the sentence under
it, three group headings, what to say when the file is not there yet, what to
say when the daemon refuses a write, what the save button says. Eighteen of the
twenty are about a settings page and not about ARK.

So the lever is not the fields. It is that **a page's own words are the same for
every game**, and they now live in `lang/*/games.php` and are shared. A game
needs six strings of its own:

| | |
| --- | --- |
| `section_helper`, `eggs`, `eggs_helper` | the admin question: which eggs are this game |
| `nav_label`, `title`, `subheading` | what the page inside a server is called |

Six keys in thirty-two languages is a hundred and ninety-two strings. Ten games
is one thousand nine hundred, not six thousand four hundred.

## The third correction, and the biggest: Palworld was already this

**`PalworldSettings` has existed for releases and this file did not mention it.**
It is a fourth game with a settings form, it is the most capable of them, and it
is the pattern the rest of this file spent two sections arguing towards.

What it does, which was written before any of this was planned:

- **It reads whatever the file holds.** `Support\Palworld\OptionSettings` parses
  the single enormous `OptionSettings=(...)` line that nearly every Palworld
  setting lives on, and writes back everything it read, including the keys it
  made no sense of, untouched and in order. Its docblock gives the reason this
  file gives: "an editor built around a fixed list shows a server's file through
  the list it was written with, which means a setting added by the game last
  month is invisible".
- **It derives a label rather than showing a bare key.** `Palworld::label()`
  takes `bIsPvP` to "Is PvP" and `PalAutoHPRegeneRateInSleep` to "Pal auto HP
  regene rate in sleep", with an abbreviation table so a run of capitals with a
  lowercase letter in it does not split into nonsense.
- **It derives a group from the key's prefix**, coarsely and on purpose, with
  Other as the place a new key lands rather than nowhere.
- **It works out a value's type from the value**, so a boolean is a toggle and a
  number is a number.

So the Unreal option-string reader that item 4 below asks for is written, the
raw-form decision this file presents as new was already the house answer, and
the claim that a raw form "cannot group, order or explain" is only true of the
version that was shipped for Terraria rather than of the approach.

**What that leaves is a real piece of work rather than an argument**:
`Filament\Server\Pages\GameConfig` should do what Palworld does. Derived
labels where a key gives something to derive from - camel case, snake case, the
part after the last dot - and the key itself where it does not, because
`maxplayers` cannot be split without a dictionary. And a field typed from its
value rather than a text box for everything.

## The other decision, which is still worth making

Drawing the fields from the file rather than from a list is still right, for a
reason that is not about translation at all: **a list goes stale and a file
cannot.** ARK's list is fifteen settings; the game has hundreds and mods add
their own. A page built from the file shows every one, including the ones that
did not exist when the release shipped.

What that costs, stated plainly rather than buried:

- The form says `bAllowFlyerCarryPvE` rather than a sentence. Somebody who does
  not already know that setting learns nothing from the page, and the page says
  so at the top rather than leaving them to conclude it is broken.
- It cannot group or order. The file's order is the page's order, because
  nothing here knows what any of these mean.
- It cannot validate a range, for the same reason.

**Both, then, and not one.** ARK and Minecraft keep their hand-written lists,
because they are the two games most panels actually run and fifteen explained
settings beat two hundred bare ones there. Everything else gets the raw form. A
game can graduate from one to the other later, and graduating is additive.

## The order, which is by reader rather than by game

One reader unlocks several games, so the games arrive in groups:

1. ~~**`Support\Minecraft\Properties`, which exists.**~~ **Terraria is built.**
   Its
   `serverconfig.txt` is `key=value` with `#` comments and most of its lines
   commented out, which is `server.properties` with a different name on it, so
   the reader needed no changes at all.

   The commented lines turned out to matter more than anything else about it.
   Terraria ships the file as an example with a `#` in front of nearly every
   setting, so a page listing only what is set would list the two or three the
   egg happened to uncomment. `Terraria::offered()` reads the commented ones too
   and hands them back as null, meaning "the game understands this and it is not
   set" - and `Properties::apply()` already appends a key the file did not have,
   so filling one in writes a real line. A field that was only a comment and is
   left empty is not written, or opening the page and pressing Save would append
   thirty empty settings to somebody's server.

   **Necesse was in this group and is not.** The egg declares its parser as
   `properties`, which is what put it here, and the file is nothing of the sort:

   ```
   SERVER = {
       port = 14159, // [0 - 65535] Server default port
       slots = 10, // [1 - 250] Server default slots
       MOTD =  // Message of the day
   }
   ```

   Tab-indented pairs inside a named block, values ending in a comma, comments
   introduced by `//`, and one key whose value is empty before its comment.
   Pelican's own declaration is not a lie - the daemon does a find and replace
   rather than a parse, and `properties` is close enough for that. It is not
   close enough for a form that has to write the file back without ruining it.
   Necesse needs a reader of its own and belongs below, with Palworld.
2. **`Support\Games\Ini`, which exists.** Sectioned INI, which is what that
   class was written for and which already keeps comments, order and unknown
   keys. The page is ready for it: everything that is not about a particular
   game now lives in `Filament\Server\Pages\GameConfig`, so Terraria's own
   page is seventy lines and the next one is four answers and a name.

   **Satisfactory and Don't Starve Together are built, and the question that
   was open here is answered.** This file asked whether a game with two files
   should get a tab apiece or a page apiece. It gets neither: the page holds a
   list of files, one section per file, headed by the file's own name, and each
   file is written separately. A game with one file reads exactly as it did
   before there were two, so nothing was paid for the games that do not need it.

   Don't Starve Together is the case that shaped it. A world there is a cluster:
   `cluster.ini` is the whole thing and each shard gets its own `server.ini`,
   Master for the surface and Caves for underground. **Two of the three files
   have the same name**, so a section headed by a basename would have been two
   identical headings, and `GameConfig::heading()` keeps the directory where it
   has to - `Master/server.ini` and `Caves/server.ini` - while a game with no
   clash still reads `Game.ini`.

   It also found a real fault in `Support\Games\Ini`, which had been shipping
   since ARK. **A rewritten line was rebuilt from its key**, so a file written
   `name = value` came back `name=value` on every line the page had touched.
   ARK writes the tight form and nothing had ever noticed. The value is now
   replaced in place and the indentation, the key and the spacing around the
   sign all survive; a key the file did not have takes whichever form the file
   uses more. `tools/ini.test.js` has ten more checks about it.

   Conan Exiles is still out, and for the reason it always was: it declares no
   configuration file in any of its eggs, so the path is not written down
   anywhere the panel can be asked. It is knowable - the game keeps
   `ServerSettings.ini` under its saved config directory - but knowing it and
   reading it are different, and the rule at the top of this file is that the
   egg says where to look.

   **Twelve games are still ready on this reader with no new work at all.**
   Astroneer, Craftopia, Night of the Dead, No One Survived, OpenRCT2, OpenTTD,
   Assetto Corsa, Archean, HumanitZ, RuneScape: Dragonwilds and Soldat are one
   file apiece; Astroneer and No One Survived keep more than one, which now
   costs nothing extra.
3. ~~**A JSON reader, which is one new class.**~~ **Built, and V Rising with
   it.** `Support\Games\Json` edits the text rather than decoding and
   re-encoding, because a round trip through `json_decode` loses key order and
   every formatting choice in the file - and these files are full of numbers
   written `1.000000` that come back as `1`.

   It was worth more than the seven games this plan guessed at. The full survey
   finds **twenty JSON files across eighteen games**, and three of them are now
   built: V Rising, Enshrouded and Factorio. **Fifteen are still waiting on
   nothing:** RimWorld, Starbound, Sons of the Forest, Eco, Onset, Puck, Portal
   Knights, TerraTech Worlds, Hogwarp, Foundry VTT, Escape from Tarkov, Star
   Rupture, The Bus, Wreckfest 2 and Zombie Survival Game Online. Several of
   those keep JSON in a file named `.cfg`, `.txt` or `.scnf`, which is why the
   parser matters more than the extension.
   And it settled what a label is worth. `Support\Games\Words` derives one
   from the key and had two rules added after the fact - `PvP`, which the
   capital splitter cut in half, and Unreal's `m` prefix, which a Satisfactory
   `Game.ini` is almost entirely made of and which read as "M Auto Pause" until
   it was taught. Both are the kind of thing only a real page shows, and neither
   was checked by anything, so `tools/words.test.js` now holds all of it.
4. **A reader for Necesse.** ~~And one for Palworld~~ - that one is written
   and shipping, see above. `PalWorldSettings.ini` is
   not INI in the way ARK's is: nearly every setting lives inside one enormous
   `OptionSettings=(Difficulty=None,DayTimeSpeedRate=1.000000,...)` line, so a
   plain INI reader sees one key. That is a reader of its own, for one game -
   and it is the game asked about most. **That work is done**: see
   `Support\Palworld\OptionSettings`. Necesse's block is the one still open,
   and it is the easier shape of the two.
5. **XML, for 7 Days to Die and Space Engineers.** Last, because PHP can parse
   XML and cannot write it back without reformatting the parts it was not asked
   to touch, which is the one promise this file will not break.


## What twenty-seven candidates actually came to

Every game left on the two readers was checked before any of it was built:
the current egg fetched and read, a real configuration file for that game found
and quoted, and the content judged against what the readers can actually do.
Each positive answer was then given to somebody else to refute, with
instructions to default to refusing.

**Two of the twenty-seven survived.** That ratio is the finding, not the two.

| | |
| --- | --- |
| Built | Onset, Craftopia |
| Buildable at a named cost | 13 |
| Not buildable | 12 |

### The twelve, and why

Six of these would have shipped a page that quietly ruins a file. The rule at
the top of this document was right and not sufficient: `json` and `ini` are
trustworthy about the *format* and say nothing about what is written in it.

| Game | What it is |
| --- | --- |
| **Night of the Dead** | 52 of its 60 lines are `Key=Value // Label`. The reader treats `;` and `#` at the start of a line as comments and nothing else, so every value would read as `0 // No Wave` and saving would write that back. Necesse again, in an ini. |
| **HumanitZ** | Its two headings are `[Host Settings]` and `[World Settings]`. A space fails the heading pattern, so neither section is recognised. The declared path is also not written by the install: the game generates it on first boot from `REF_GameServerSettings.ini`. |
| **Astroneer** | `PlayerProperties=` repeats once per known player inside one section. The reader lets a later key win, so reading and writing the file back collapses the whole player list into one entry. |
| **OpenTTD** | The egg installs 13.0-RC2 and ships a 1.8.0 `openttd.cfg`. OpenTTD 12 moved the passwords to `secrets.cfg` and the server name to `private.cfg`, so a page built on this file offers four password fields that the running server never reads. It also has fifteen identical `none = start_date=730` lines that exist to allocate AI slots. |
| **The Bus** | UTF-16 LE, and no enclosing braces: the file is a brace-less sequence of key and value. |
| **Sons of the Forest** | Keys with literal dots in them - `"Gameplay.TreeRegrowth"` inside `GameSettings`. A dotted path cannot tell that from a nested object, which is a limit of the reader rather than of the game. |
| **Archean** | The egg still works and the game behind it does not: `GIT_ADDRESS` points at a repository that now answers 404, so the install clones nothing and the config file lands where no binary will read it. |
| **Star Rupture** | Five settings. |
| **RuneScape: Dragonwilds** | Eight keys, most of them the game's own state. |
| **Stay in Tarkov** | Six scalars, four of which the egg rewrites from the allocation. |
| **Puck** | Its admin list is an empty array, so the setting people actually want is the one the page cannot offer. |
| **Zombie Survival Game Online** | Seven settings. |

### What it found in code that is already shipping

`Support\Games\Json` is a scanner, and a scanner handed something that is
nearly JSON keeps going. Starbound writes a documented JSON superset with `//`
comments in it, which is what raised the question - and the answer was that a
file with one comment in it produced **three editable fields named 0, 1 and 2**
holding `//`, `how` and `many`. Editing one spliced text into the middle of a
comment.

Starbound is not built and neither is anything else that writes comments. A
person adding a note to their own `ServerHostSettings.json` does, and nothing
stopped that. `parse()` and `apply()` now ask a strict parser whether the
document is JSON at all before either of them touches it: nothing read and
nothing written, rather than fragments. `tools/json.test.js` carries ten checks
about it.

### The thirteen with a cost

Not built, and not refused either. Each is real and each carries something a
person should be told before the page is offered: Starbound rewrites its own
config when an admin command changes a setting; Portal Knights' egg fetches its
default from a paste that now 404s; Assetto Corsa declares its parser as `file`
rather than `ini`, which by the rule at the top of this document is not
evidence about the format; TerraTech Worlds stores some numbers as quoted
strings beside real booleans in the same block; OpenRCT2 holds 175 settings of
which a large part is single-player client state that does nothing on a
headless server. The full reasoning per game is in the run that produced this.

## What reading the eggs actually settled

The table above came from `config.files`, which is the panel's own statement
about a game's configuration file. It is evidence about **where** and weaker
evidence about **what**: the daemon rewrites these files with a find and
replace, so a declared parser only has to be close enough for that. Necesse is
declared `properties` and is a nested block with trailing commas. ARK: Survival
Evolved declares nothing and has one of the files this plugin already edits.

So the egg says where to look. What is in there has to be looked at.

## Deliberately not in this

- **A section for a game that Pelican's Startup page already covers.** The
  Valheim rule. Rust, Squad, DayZ and most of `games-steamcmd` are start-up
  flags with a thin `.cfg` beside them, and a page that duplicates the Startup
  tab is worse than no page.
- **Matching eggs by name.** `Support\Games` says why at length: a panel's eggs
  are named by whoever made them, and "Rust", "Rust (Staging)" and
  "rust-oxide-2024" are one game. An administrator ticks which eggs are which,
  for every game, always.
- **Shipping the eggs.** This plugin does not install anything from
  pelican-eggs and should not. It reads the eggs a panel already has.
- **A page per game.** One row in the sidebar per game is a sidebar about games.
  Sections on one page, which is what the current page already says.
- **Validating values against the game.** Knowing that `XPMultiplier` must be
  positive means knowing what `XPMultiplier` is, which is the hand-written path
  this exists to avoid.

## How you check it works

1. A server of that game, with the file already written by the game itself.
   Open the page, change one value, save, and read the file on the node: the
   changed line is changed and **every other line is byte for byte what it was**,
   comments and blank lines included. That is the whole test, and it is the one
   `Ini` was written against.
2. A file with a key this plugin has never heard of. It has to survive a save.
3. A server whose file does not exist yet, which has to say so rather than write
   a file the game will then overwrite.
4. An egg list left empty, which is the per-game off switch and has to leave the
   section drawing nothing.

## What could make this plan wrong

- **Pelican grows a config-file editor of its own.** The house rule applies: read
  their source, delete the half of this that duplicates it. The file manager
  already edits these files as text, so what this adds is a form and nothing
  else - if that gap closes, so does this plan.
- **The raw form is unusable in practice.** It is a real risk and the honest
  test is one game shipped that way, looked at by somebody who runs that game,
  before the other six are built on the same pattern.
- **A game's file is not the thing people change.** Most of these games are
  configured on the Startup tab and the file is an afterthought. Every candidate
  above has to survive that question individually, and the ones that do not are
  Valheim: a section nobody needs, kept working forever.

<?php

return [
    'groups' => [
        'appearance' => 'Appearance',
        'background' => 'Background',
        'background_helper' => 'Applies to the whole panel, including the login screen.',
        'icons' => 'Icons',
        'bars' => 'Resource meters',
        'bars_helper' => 'The CPU, memory and disk bars on the server cards.',
        'updates' => 'Updates',
        'updates_helper' => 'Which releases the Theme page offers, and where it looks for them.',
        'brand' => 'Brand',
        'login' => 'Login screen',
        'login_helper' => 'Applies to the sign-in, password reset and two-factor screens.',
        'advanced' => 'Custom CSS',
        'advanced_helper' => 'For anything the settings above do not cover. Loaded after everything else, so it wins.',
        'areas' => 'Per area',
        'areas_helper' => 'Everything above applies everywhere. Here you can set one area apart; anything left empty keeps following the global setting.',
    ],

    'preset' => [
        'label' => 'Style',
        'helper' => 'Pick a look to start from. It fills in everything below, which you can then change. None turns the theme off and leaves the panel exactly as Pelican ships it.',
        'options' => [
            'none' => 'None - no theme',
            'legend' => 'Legend - red fire into blue lightning',
            'ember' => 'Ember - warm black, orange accent',
            'midnight' => 'Midnight - deep blue, calm',
            'crimson' => 'Crimson - red, sharp corners, compact',
            'forest' => 'Forest - green, rounded, no glow',
            'nebula' => 'Nebula - purple with a gradient backdrop',
            'mono' => 'Mono - greyscale, flat and dense',
        ],
    ],

    'surface' => [
        'label' => 'Surface colour',
        'helper' => 'The cards and panels. Lighter and darker shades are derived from it.',
        'placeholder' => 'Follow the theme',
    ],

    'radius' => [
        'label' => 'Corners',
    ],

    'accent' => [
        'label' => 'Accent colour',
        'helper' => 'Used for buttons, links, the active navigation item and focus rings.',
    ],
    'density' => [
        'label' => 'Density',
        'helper' => 'Compact tightens the spacing so more rows fit on screen.',
        'comfortable' => 'Comfortable',
        'compact' => 'Compact',
    ],
    'force_dark' => [
        'label' => 'Force dark mode',
        'helper' => 'Hides the light/dark switcher and keeps every user on the dark theme.',
    ],
    'glass' => [
        'label' => 'Frosted topbar',
        'helper' => 'Blurs the topbar and modal backdrops. Turn off on low-end devices.',
    ],
    'glow' => [
        'label' => 'Accent glow',
        'helper' => 'Soft accent shadow on primary buttons, active navigation and the login card.',
    ],

    'background' => [
        'label' => 'Background type',
        'helper' => "Aurora is the theme's own background: accent glows with a fine grain.",
        'aurora' => 'Aurora (default)',
        'solid' => 'Single colour',
        'gradient' => 'Gradient',
        'image' => 'Image',
        'color' => 'Colour',
        'color_end' => 'Second colour',
        'angle' => 'Direction',
        'upload' => 'Upload an image',
        'upload_helper' => 'Up to 8 MB. An uploaded image takes precedence over the URL below.',
        'url' => 'Or a URL',
        'url_helper' => 'Must start with https:// and be reachable from outside.',
        'dim' => 'Dim',
        'dim_helper' => 'Without dimming, white text on a bright photo is unreadable.',
        'blur' => 'Blur',
    ],

    'channel' => [
        'label' => 'Update channel',
        'helper' => 'Which releases the Theme page offers. Beta gets new versions first, and gets the rough edges first too.',
        'stable' => 'Stable',
        'beta' => 'Beta',
        'beta_url' => 'Beta feed (optional)',
        'beta_url_helper' => 'Leave empty. The address shown below the field is worked out from the stable feed and is the one being used; fill this in only for a beta published somewhere else.',
        'dev' => 'Dev (working branch)',
        'dev_url' => 'Dev feed (optional)',
        'dev_url_helper' => 'Leave empty. The address shown below the field is worked out from the stable feed and is the one being used; fill this in only for a dev build published somewhere else.',
        'auto' => [
            'label' => 'Install updates automatically',
            'helper' => 'Installs a new release on the selected channel on its own. The panel rebuilds its assets while it runs and is unavailable for a few minutes, so daily and weekly go at 04:00.',
            'off' => 'Off — update by hand',
            'hourly' => 'Every hour',
            'daily' => 'Every day (04:00)',
            'weekly' => 'Every week (Monday 04:00)',
        ],
    ],

    'arranger' => [
        'label' => 'Page arranger',
        'helper' => 'Shows the Arrange page button to anyone holding the Arrange permission. Off hides it for everyone; layouts already saved stay in place.',
    ],

    'brand' => [
        'logo_height' => 'Logo height',
        'logo_height_helper' => 'Pelican ships 2rem. Larger values make the sidebar header taller with it.',
        'logo_url' => 'Logo override',
        'logo_url_helper' => "Leave empty to keep whatever Pelican's own settings point at.",
    ],

    'login' => [
        'image' => 'Background image',
        'image_helper' => 'Just for the login screen. Without one it keeps showing the panel background.',
        'url' => 'Or a URL',
        'blur' => 'Card blur',
        'blur_helper' => 'Frosts the card so the picture behind it shows through.',
        'width' => 'Card width',
    ],

    'advanced' => [
        'css' => 'Custom CSS',
        'css_helper' => 'Up to 100 KB. Saved to storage, not to .env.',
        'reference' => 'CSS reference',
        'reference_helper' => 'Every variable and class this theme and the panel expose.',
    ],

    'areas' => [
        'add' => 'Add an area',
        'area' => 'Area',
        'inherit' => 'Global',
        'radius' => 'Corners',
        'radius_sharp' => 'Sharp',
        'radius_normal' => 'Normal',
        'radius_round' => 'Round',
        'surface' => 'Surface colour',
        'surface_helper' => 'The cards and panels inside this area; lighter and darker shades are derived from it.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Console (rest of the page)',
            'files' => 'Files page',
            'edit' => 'Edit page',
            'server' => 'Other server pages and tabs',
        ],
    ],

    'bars' => [
        'base' => 'Base colour',
        'base_green' => 'Green',
        'base_accent' => 'Accent colour',
        'warning' => 'Amber from',
        'danger' => 'Red from',
    ],

    'icons' => [
        'stroke' => 'Line weight',
        'stroke_thin' => 'Thin',
        'stroke_normal' => 'Normal',
        'stroke_bold' => 'Bold',
        'scale' => 'Size',
        'accent' => 'Menu icons in the accent colour',
        'accent_helper' => 'Applies to the icons in the sidebar and the topbar.',
        'overrides' => 'Replace icons',
        'overrides_helper' => "Left: part of the menu item's link (console, files, backups, schedules, users, databases, network, activity, mounts, startup, settings, webhooks). Right: a Tabler icon name such as tabler-folder. An unknown name leaves Pelican's own icon in place.",
        'overrides_key' => 'Menu item',
        'overrides_value' => 'Icon',
    ],
];

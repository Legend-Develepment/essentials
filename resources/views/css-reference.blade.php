@php
    /**
     * A reference of what this theme exposes and what the panel's own classes
     * are called, so custom CSS can be written without digging through the
     * rendered HTML first.
     */
    $tokens = [
        'Colour' => [
            '--primary-50 … --primary-950' => 'The accent ramp, built from the accent colour',
            '--gray-50 … --gray-950' => 'The neutral ramp; the dark surfaces come out of 800/900/950',
            '--ld-surface' => 'Cards and panels',
            '--ld-raised' => 'A step above the surface: server cards, tooltips, widgets',
            '--ld-sunken' => 'A step below: table containers, the terminal, the editor',
            '--ld-border' => 'Hairline around a surface',
            '--ld-border-strong' => 'Hairline on hover or on an active item',
            '--ld-tint' => 'Accent wash behind an active item',
            '--ld-tint-subtle' => 'The same wash, for hover states',
            '--ld-edge' => 'The light line along the top of a card',
        ],
        'Shape and depth' => [
            '--ld-radius' => 'Corner radius of cards, tables and modals',
            '--ld-radius-sm' => 'Corner radius of buttons and smaller pieces',
            '--ld-density' => 'Spacing multiplier: 1 comfortable, 0.72 compact',
            '--ld-shadow' => 'Card shadow',
            '--ld-shadow-lg' => 'Shadow on hover or for a modal',
            '--ld-glow' => 'Accent glow on primary buttons',
            '--ld-glow-strong' => 'The heavier glow',
            '--ld-blur' => 'Backdrop blur for the topbar and modal backdrops',
        ],
        'Components' => [
            '--ld-icon-stroke' => 'Icon line weight',
            '--ld-icon-scale' => 'Icon size multiplier',
            '--ld-terminal-bg / --ld-terminal-fg' => 'Console colours, read by the runtime script',
            '--ld-editor-bg / --ld-editor-fg' => 'File editor colours',
            '--ld-bar-ok / --ld-bar-warn / --ld-bar-crit' => 'Resource meter levels',
            '--ld-login-width / --ld-login-blur' => 'The login card',
        ],
    ];

    $classes = [
        'Layout' => [
            '.fi-body' => 'The page itself, and where the background is painted',
            '.fi-sidebar / .fi-sidebar-item-btn' => 'Sidebar and its menu items (.fi-active when current)',
            '.fi-topbar' => 'The bar across the top',
            '.fi-main' => 'The content column',
            '.fi-page / .fi-page-content' => 'The page wrapper',
            '.fi-header-heading' => 'The page title',
        ],
        'Surfaces' => [
            '.fi-section' => 'A card; .fi-section-not-contained is a headless group',
            '.fi-sc-tabs.fi-contained' => 'A tab strip inside a card',
            '.fi-tabs-item' => 'One tab (.fi-active when selected)',
            '.fi-modal-window' => 'A dialog',
            '.fi-dropdown-panel' => 'Any dropdown, including the select',
            '.fi-wi-stats-overview-stat' => 'A dashboard stat tile',
        ],
        'Tables' => [
            '.fi-ta-ctn' => 'The table card',
            '.fi-ta-header-cell' => 'A column heading',
            '.fi-ta-row' => 'A row; .fi-clickable when it links somewhere',
            '.fi-ta-cell' => 'A cell',
            '.fi-pagination' => 'The pager below a table',
        ],
        'Forms' => [
            '.fi-input-wrp' => 'The frame around any input',
            '.fi-input' => 'The input itself',
            '.fi-fo-field-label' => 'A field label',
            '.fi-fo-checkbox-list-option' => 'One option in a permission list',
            '.fi-fo-key-value-table' => 'Startup commands, docker images, variables',
            '.fi-fo-toggle-buttons' => 'The radio pills',
            '.fi-toggle' => 'A switch (.fi-toggle-on when on)',
            '.fi-btn' => 'A button; .fi-color-primary for the accent one',
        ],
        'Pelican specific' => [
            '[wire\\:id]:has(> .fi-color)' => 'A server card on the server list',
            '[role="progressbar"]' => 'A resource meter; data-ld-level is ok, warn or crit',
            '#terminal' => 'The console',
            '.fme-element-wrapper' => 'The frame around the file editor',
            '.monaco-editor' => 'The editor; its colours are --vscode-* properties',
            '.fi-small-stat-block' => 'The blocks above the console',
        ],
    ];
@endphp

<div class="fi-sc-text" style="display: grid; gap: 1.5rem;">
    <p>
        Everything below is available to the CSS box. Theme rules are emitted
        before yours, so no <code>!important</code> is needed to override them.
        Prefix a rule with <code>html.dark</code> to target dark mode only.
    </p>

    <div
        style="
            background-color: var(--ld-sunken, rgb(0 0 0 / 0.2));
            border-radius: var(--ld-radius-sm, 0.5rem);
            box-shadow: inset 0 0 0 1px var(--ld-border, rgb(255 255 255 / 0.1));
            padding: 0.75rem 1rem;
        "
    >
        <code style="white-space: pre-wrap;">html.dark .fi-sidebar-item-btn { border-radius: 0; }
html.dark .fi-topbar { --ld-blur: none; }
html[data-ld-area='console'] .fi-page { --ld-radius: 0.25rem; }</code>
    </div>

    @foreach ($tokens as $group => $rows)
        <div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Variables — {{ $group }}</h3>

            <div style="display: grid; gap: 0.35rem;">
                @foreach ($rows as $name => $description)
                    <div style="display: grid; grid-template-columns: minmax(0, 22rem) minmax(0, 1fr); gap: 1rem;">
                        <code>{{ $name }}</code>
                        <span>{{ $description }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @foreach ($classes as $group => $rows)
        <div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Classes — {{ $group }}</h3>

            <div style="display: grid; gap: 0.35rem;">
                @foreach ($rows as $name => $description)
                    <div style="display: grid; grid-template-columns: minmax(0, 22rem) minmax(0, 1fr); gap: 1rem;">
                        <code>{{ $name }}</code>
                        <span>{{ $description }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <p>
        Attributes worth knowing: <code>data-ld-area</code> on
        <code>&lt;html&gt;</code> is console, files, edit or server on the client
        panel, and <code>data-ld-level</code> on a resource meter is ok, warn or
        crit.
    </p>
</div>

/*
 * Levels for Pelican's resource meters.
 *
 * The colour itself lives in the stylesheet; this only decides which level a bar
 * is at and writes it to data-ld-level. It has to happen here because the
 * thresholds Pelican renders with are chained onto the column after the
 * component manager has configured it, so a plugin cannot change them server
 * side - but the rendered bar does carry its own percentage.
 *
 * If Pelican ever changes this markup, nothing breaks: no bars are found, and
 * the panel keeps its own colours.
 */

const FALLBACK_WARNING = 50;
const FALLBACK_DANGER = 80;

const SELECTOR = '[role="progressbar"]';

/*
 * Reading a custom property means asking for the computed style, which is a
 * style recalculation - not something to do sixty times a second when the two
 * numbers only change when the stylesheet does.
 */
let cached = null;

function thresholds() {
    if (cached) {
        return cached;
    }

    const styles = getComputedStyle(document.documentElement);
    const warning = parseFloat(styles.getPropertyValue('--ld-bar-warning'));
    const danger = parseFloat(styles.getPropertyValue('--ld-bar-danger'));

    cached = {
        warning: Number.isFinite(warning) ? warning : FALLBACK_WARNING,
        danger: Number.isFinite(danger) ? danger : FALLBACK_DANGER,
    };

    return cached;
}

function percentage(track) {
    const fill = track.firstElementChild;
    const width = fill?.style?.width ? parseFloat(fill.style.width) : NaN;

    if (Number.isFinite(width)) {
        return width;
    }

    // Fall back to the ARIA values the bar already exposes.
    const now = parseFloat(track.getAttribute('aria-valuenow'));
    const max = parseFloat(track.getAttribute('aria-valuemax'));

    return Number.isFinite(now) && Number.isFinite(max) && max > 0 ? (now / max) * 100 : 0;
}

function paint() {
    const { warning, danger } = thresholds();

    document.querySelectorAll(SELECTOR).forEach((track) => {
        const percent = percentage(track);

        track.dataset.ldLevel = percent >= danger ? 'crit' : percent >= warning ? 'warn' : 'ok';
    });
}

let queued = false;

function schedule() {
    if (queued) {
        return;
    }

    queued = true;

    requestAnimationFrame(() => {
        queued = false;
        paint();
    });
}

schedule();

document.addEventListener('livewire:navigated', () => {
    // A new page can be under a different area's colours and thresholds.
    cached = null;
    schedule();
});

document.addEventListener('livewire:init', () => {
    if (typeof window.Livewire?.hook !== 'function') {
        return;
    }

    window.Livewire.hook('morphed', schedule);
    window.Livewire.hook('morph.updated', schedule);
});

/*
 * The server cards poll every 15 seconds and often only the inline width
 * changes, so that is watched as well. Writing data-ld-level cannot retrigger
 * this: the filter only listens for style.
 *
 * Every animation and transition in the panel writes inline styles too, though,
 * and a scan of the whole document per frame to find that nothing moved is a
 * waste of a frame. Each record is checked first, so the scan only runs when
 * something that is actually a bar changed.
 */
function touchesBar(record) {
    if (record.type === 'attributes') {
        const target = record.target;

        // Either the track itself, or the fill inside it whose width moved.
        return (
            target instanceof Element &&
            target.matches(`${SELECTOR}, ${SELECTOR} > *`)
        );
    }

    for (const node of record.addedNodes) {
        if (node instanceof Element && (node.matches(SELECTOR) || node.querySelector(SELECTOR))) {
            return true;
        }
    }

    return false;
}

new MutationObserver((records) => {
    if (records.some(touchesBar)) {
        schedule();
    }
}).observe(document.documentElement, {
    subtree: true,
    childList: true,
    attributes: true,
    attributeFilter: ['style'],
});

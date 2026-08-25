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

function thresholds() {
    const styles = getComputedStyle(document.documentElement);
    const warning = parseFloat(styles.getPropertyValue('--ld-bar-warning'));
    const danger = parseFloat(styles.getPropertyValue('--ld-bar-danger'));

    return {
        warning: Number.isFinite(warning) ? warning : FALLBACK_WARNING,
        danger: Number.isFinite(danger) ? danger : FALLBACK_DANGER,
    };
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

    document.querySelectorAll('[role="progressbar"]').forEach((track) => {
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

document.addEventListener('livewire:navigated', schedule);

document.addEventListener('livewire:init', () => {
    if (typeof window.Livewire?.hook !== 'function') {
        return;
    }

    window.Livewire.hook('morphed', schedule);
    window.Livewire.hook('morph.updated', schedule);
});

// The server cards poll every 15 seconds and often only the inline width
// changes, so that is watched as well. Writing data-ld-level cannot retrigger
// this: the filter only listens for style.
new MutationObserver(schedule).observe(document.documentElement, {
    subtree: true,
    childList: true,
    attributes: true,
    attributeFilter: ['style'],
});

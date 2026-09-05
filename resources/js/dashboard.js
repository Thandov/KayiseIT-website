document.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector('.profile-shell');
    if (!root) return;

    const tabButtons = root.querySelectorAll('[data-tab]');
    const panels = root.querySelectorAll('[data-tab-panel]');

    function activateTab(button) {
        if (!button || button.disabled || button.dataset.locked) return;

        const name = button.dataset.tab;
        tabButtons.forEach((btn) => {
            btn.classList.toggle('is-active', btn === button);
        });
        panels.forEach((panel) => {
            const match = panel.dataset.tabPanel === name;
            panel.classList.toggle('is-active', match);
            panel.hidden = !match;
        });
    }

    tabButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            if (btn.disabled || btn.dataset.locked) return;
            activateTab(btn);
        });
    });

    // Honour data-initial-tab on the shell (e.g. when personal info is required)
    const initialTabName = root.dataset.initialTab;
    const startBtn = initialTabName
        ? root.querySelector(`[data-tab="${initialTabName}"]`)
        : tabButtons[0];

    if (startBtn) {
        activateTab(startBtn);
    }

    const jumpButtons = root.querySelectorAll('[data-tab-jump]');
    jumpButtons.forEach((jump) => {
        jump.addEventListener('click', (e) => {
            e.preventDefault();
            const target = jump.getAttribute('data-tab-jump');
            const btn = root.querySelector(`[data-tab="${target}"]`);
            if (btn && !btn.disabled && !btn.dataset.locked) {
                activateTab(btn);
                btn.scrollIntoView({ block: 'nearest', inline: 'start', behavior: 'smooth' });
            }
        });
    });
});

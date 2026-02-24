document.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector('.profile-shell');
    if (!root) return;

    const tabButtons = root.querySelectorAll('[data-tab]');
    const panels = root.querySelectorAll('[data-tab-panel]');

    function activateTab(button) {
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
        btn.addEventListener('click', () => activateTab(btn));
    });

    const first = tabButtons[0];
    if (first) {
        activateTab(first);
    }

    const jumpButtons = root.querySelectorAll('[data-tab-jump]');
    jumpButtons.forEach((jump) => {
        jump.addEventListener('click', (e) => {
            e.preventDefault();
            const target = jump.getAttribute('data-tab-jump');
            const btn = root.querySelector(`[data-tab="${target}"]`);
            if (btn) {
                activateTab(btn);
                btn.scrollIntoView({ block: 'nearest', inline: 'start', behavior: 'smooth' });
            }
        });
    });
});


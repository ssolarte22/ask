(() => {
    if (window.__askAccessibilityInitialized) {
        return;
    }
    window.__askAccessibilityInitialized = true;

    const STORAGE_KEY = 'askAccessibilityState';
    const FONT_MIN = 0.85;
    const FONT_MAX = 1.35;
    const FONT_STEP = 0.05;

    const state = loadState();
    const body = document.body;

    function loadState() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            return raw ? JSON.parse(raw) : {};
        } catch {
            return {};
        }
    }

    function saveState() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
    }

    function setClass(name, enabled) {
        body.classList.toggle(name, !!enabled);
    }

    function applyState() {
        document.documentElement.style.setProperty('--ask-font-scale', String(state.fontScale || 1));
        setClass('ask-a11y-contrast', state.contrast);
        setClass('ask-a11y-dark', state.theme === 'dark');
        setClass('ask-a11y-light', state.theme === 'light');
        setClass('ask-a11y-grayscale', state.grayscale);
        setClass('ask-a11y-readable', state.readable);
        setClass('ask-a11y-underline', state.underline);
        updateButtonStates();
    }

    function updateButtonStates() {
        const map = [
            ['a11y-theme-light', state.theme === 'light'],
            ['a11y-theme-dark', state.theme === 'dark'],
            ['a11y-contrast', !!state.contrast],
            ['a11y-grayscale', !!state.grayscale],
            ['a11y-readable', !!state.readable],
            ['a11y-underline', !!state.underline],
        ];

        for (const [id, active] of map) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.toggle('is-active', active);
                el.setAttribute('aria-pressed', active ? 'true' : 'false');
            }
        }
    }

    function openPanel() {
        panel.classList.add('is-open');
        backdrop.classList.add('is-open');
        fab.setAttribute('aria-expanded', 'true');
    }

    function closePanel() {
        panel.classList.remove('is-open');
        backdrop.classList.remove('is-open');
        fab.setAttribute('aria-expanded', 'false');
    }

    function setTheme(theme) {
        state.theme = theme;
        saveState();
        applyState();
    }

    function toggle(flag) {
        state[flag] = !state[flag];
        if (flag === 'contrast' && state[flag]) {
            state.theme = 'light';
        }
        saveState();
        applyState();
    }

    function adjustFont(delta) {
        const next = Math.min(FONT_MAX, Math.max(FONT_MIN, Number((state.fontScale || 1) + delta).toFixed(2)));
        state.fontScale = next;
        saveState();
        applyState();
    }

    function resetAll() {
        state.fontScale = 1;
        state.theme = 'light';
        state.contrast = false;
        state.grayscale = false;
        state.readable = false;
        state.underline = false;
        saveState();
        applyState();
    }

    const widget = document.createElement('div');
    widget.className = 'ask-a11y-widget';
    widget.innerHTML = `
        <div class="ask-a11y-backdrop" id="ask-a11y-backdrop"></div>
        <div class="ask-a11y-panel" id="ask-a11y-panel" role="dialog" aria-label="Opciones de accesibilidad" aria-modal="true">
            <h2>Accesibilidad</h2>
            <p>Personaliza la lectura y el contraste. Se guarda en tu navegador.</p>

            <h3>Tamaño de texto</h3>
            <div class="ask-a11y-row ask-a11y-row--3">
                <button type="button" class="ask-a11y-btn" id="a11y-font-dec">A−</button>
                <button type="button" class="ask-a11y-btn" id="a11y-font-reset">A</button>
                <button type="button" class="ask-a11y-btn" id="a11y-font-inc">A+</button>
            </div>

            <h3>Tema</h3>
            <div class="ask-a11y-row ask-a11y-row--3">
                <button type="button" class="ask-a11y-btn" id="a11y-theme-light">Claro</button>
                <button type="button" class="ask-a11y-btn" id="a11y-theme-dark">Oscuro</button>
            </div>

            <h3>Visualización</h3>
            <div class="ask-a11y-row">
                <button type="button" class="ask-a11y-btn" id="a11y-contrast">Contraste</button>
                <button type="button" class="ask-a11y-btn" id="a11y-grayscale">Grises</button>
                <button type="button" class="ask-a11y-btn" id="a11y-underline">Enlaces</button>
                <button type="button" class="ask-a11y-btn" id="a11y-readable">Legible</button>
            </div>

            <div class="ask-a11y-footer">
                <button type="button" class="ask-a11y-btn" id="a11y-reset">Restablecer</button>
                <button type="button" class="ask-a11y-btn" id="a11y-close">Cerrar</button>
            </div>
        </div>
        <button type="button" class="ask-a11y-fab" id="a11y-fab" aria-haspopup="dialog" aria-expanded="false" aria-label="Accesibilidad">
            <span aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" focusable="false" aria-hidden="true">
                    <path d="M10.5 4a6.5 6.5 0 1 1 0 13 6.5 6.5 0 0 1 0-13zm0 2a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9zm6.44 8.94 3.56 3.56-1.41 1.41-3.56-3.56a8.5 8.5 0 1 1 1.41-1.41z"/>
                </svg>
            </span>
        </button>
    `;

    document.body.appendChild(widget);

    const panel = document.getElementById('ask-a11y-panel');
    const backdrop = document.getElementById('ask-a11y-backdrop');
    const fab = document.getElementById('a11y-fab');

    fab.addEventListener('click', () => {
        const isOpen = panel.classList.contains('is-open');
        if (isOpen) {
            closePanel();
        } else {
            openPanel();
        }
    });

    backdrop.addEventListener('click', closePanel);
    document.getElementById('a11y-close').addEventListener('click', closePanel);
    document.getElementById('a11y-font-dec').addEventListener('click', () => adjustFont(-FONT_STEP));
    document.getElementById('a11y-font-reset').addEventListener('click', () => {
        state.fontScale = 1;
        saveState();
        applyState();
    });
    document.getElementById('a11y-font-inc').addEventListener('click', () => adjustFont(FONT_STEP));

    document.getElementById('a11y-theme-light').addEventListener('click', () => setTheme('light'));
    document.getElementById('a11y-theme-dark').addEventListener('click', () => setTheme('dark'));

    document.getElementById('a11y-contrast').addEventListener('click', () => toggle('contrast'));
    document.getElementById('a11y-grayscale').addEventListener('click', () => toggle('grayscale'));
    document.getElementById('a11y-readable').addEventListener('click', () => toggle('readable'));
    document.getElementById('a11y-underline').addEventListener('click', () => toggle('underline'));
    document.getElementById('a11y-reset').addEventListener('click', resetAll);

    applyState();
})();

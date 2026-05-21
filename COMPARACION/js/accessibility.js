(function () {
  'use strict';

  var STORAGE_KEY = 'entrega_ia_a11y';
  var HINT_KEY = 'entrega_ia_a11y_hint_seen';

  var defaults = {
    themePreference: 'light',
    fontScale: 0,
    contrast: false,
    grayscale: false,
    underlineLinks: false,
    readableFont: false,
    spacing: false,
    lineHeight: false,
    reduceMotion: false,
  };

  var state = loadState();
  var panelOpen = false;

  function loadState() {
    try {
      var saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
      if (saved.theme && !saved.themePreference) {
        saved.themePreference = saved.theme === 'dark' ? 'dark' : 'light';
      }
      return Object.assign({}, defaults, saved);
    } catch (e) {
      return Object.assign({}, defaults);
    }
  }

  function saveState() {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
  }

  function applyState() {
    var html = document.documentElement;
    var theme = state.themePreference === 'system'
      ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
      : (state.themePreference === 'dark' ? 'dark' : 'light');

    html.classList.remove(
      'a11y-theme-dark', 'a11y-theme-light',
      'a11y-font-1', 'a11y-font-2', 'a11y-font-3', 'a11y-font-4',
      'a11y-contrast', 'a11y-grayscale', 'a11y-underline-links',
      'a11y-readable-font', 'a11y-spacing', 'a11y-line-height', 'a11y-reduce-motion'
    );

    html.classList.add(theme === 'dark' ? 'a11y-theme-dark' : 'a11y-theme-light');
    if (state.fontScale > 0) html.classList.add('a11y-font-' + state.fontScale);
    if (state.contrast) html.classList.add('a11y-contrast');
    if (state.grayscale) html.classList.add('a11y-grayscale');
    if (state.underlineLinks) html.classList.add('a11y-underline-links');
    if (state.readableFont) html.classList.add('a11y-readable-font');
    if (state.spacing) html.classList.add('a11y-spacing');
    if (state.lineHeight) html.classList.add('a11y-line-height');
    if (state.reduceMotion) html.classList.add('a11y-reduce-motion');

    syncButtons();
  }

  function syncButtons() {
    setPressed('a11y-theme-light', state.themePreference === 'light');
    setPressed('a11y-theme-dark', state.themePreference === 'dark');
    setPressed('a11y-theme-system', state.themePreference === 'system');
    setPressed('a11y-contrast', state.contrast);
    setPressed('a11y-grayscale', state.grayscale);
    setPressed('a11y-underline', state.underlineLinks);
    setPressed('a11y-readable', state.readableFont);
    setPressed('a11y-spacing', state.spacing);
    setPressed('a11y-line-height', state.lineHeight);
    setPressed('a11y-motion', state.reduceMotion);
  }

  function setPressed(id, pressed) {
    var btn = document.getElementById(id);
    if (btn) btn.setAttribute('aria-pressed', pressed ? 'true' : 'false');
  }

  function changeFont(delta) {
    state.fontScale = Math.max(0, Math.min(4, state.fontScale + delta));
    saveState();
    applyState();
  }

  function toggle(key) {
    state[key] = !state[key];
    saveState();
    applyState();
  }

  function resetAll() {
    state = Object.assign({}, defaults);
    saveState();
    applyState();
  }

  function getFocusable(panel) {
    return panel.querySelectorAll(
      'button:not([disabled]), [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
  }

  function openPanel() {
    var panel = document.getElementById('a11y-panel');
    var fab = document.getElementById('a11y-fab');
    var backdrop = document.getElementById('a11y-backdrop');
    if (!panel || !fab) return;

    panel.hidden = false;
    panel.classList.add('is-open');
    fab.setAttribute('aria-expanded', 'true');
    if (backdrop) {
      backdrop.hidden = false;
      backdrop.classList.add('is-visible');
      backdrop.setAttribute('aria-hidden', 'false');
    }
    panelOpen = true;
    document.body.classList.add('a11y-panel-open');

    var focusable = getFocusable(panel);
    if (focusable.length) focusable[0].focus();
  }

  function closePanel() {
    var panel = document.getElementById('a11y-panel');
    var fab = document.getElementById('a11y-fab');
    var backdrop = document.getElementById('a11y-backdrop');
    if (!panel || !fab) return;

    panel.classList.remove('is-open');
    fab.setAttribute('aria-expanded', 'false');
    if (backdrop) {
      backdrop.classList.remove('is-visible');
      backdrop.setAttribute('aria-hidden', 'true');
    }
    panelOpen = false;
    document.body.classList.remove('a11y-panel-open');

    setTimeout(function () {
      if (!panel.classList.contains('is-open')) {
        panel.hidden = true;
        if (backdrop) backdrop.hidden = true;
      }
    }, 280);

    fab.focus();
  }

  function initWidget() {
    var fab = document.getElementById('a11y-fab');
    var panel = document.getElementById('a11y-panel');
    var backdrop = document.getElementById('a11y-backdrop');
    if (!fab || !panel) return;

    if (!localStorage.getItem(HINT_KEY) && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      fab.classList.add('a11y-fab--hint');
      localStorage.setItem(HINT_KEY, '1');
    }

    fab.addEventListener('click', function (e) {
      e.stopPropagation();
      if (panelOpen) closePanel();
      else openPanel();
    });

    backdrop?.addEventListener('click', closePanel);

    document.getElementById('a11y-close')?.addEventListener('click', closePanel);
    document.getElementById('a11y-close-top')?.addEventListener('click', closePanel);
    document.getElementById('a11y-reset')?.addEventListener('click', resetAll);

    document.getElementById('a11y-font-dec')?.addEventListener('click', function () { changeFont(-1); });
    document.getElementById('a11y-font-inc')?.addEventListener('click', function () { changeFont(1); });
    document.getElementById('a11y-font-reset')?.addEventListener('click', function () {
      state.fontScale = 0;
      saveState();
      applyState();
    });

    document.getElementById('a11y-theme-light')?.addEventListener('click', function () {
      state.themePreference = 'light';
      saveState();
      applyState();
    });
    document.getElementById('a11y-theme-dark')?.addEventListener('click', function () {
      state.themePreference = 'dark';
      saveState();
      applyState();
    });
    document.getElementById('a11y-theme-system')?.addEventListener('click', function () {
      state.themePreference = 'system';
      saveState();
      applyState();
    });

    document.getElementById('a11y-contrast')?.addEventListener('click', function () { toggle('contrast'); });
    document.getElementById('a11y-grayscale')?.addEventListener('click', function () { toggle('grayscale'); });
    document.getElementById('a11y-underline')?.addEventListener('click', function () { toggle('underlineLinks'); });
    document.getElementById('a11y-readable')?.addEventListener('click', function () { toggle('readableFont'); });
    document.getElementById('a11y-spacing')?.addEventListener('click', function () { toggle('spacing'); });
    document.getElementById('a11y-line-height')?.addEventListener('click', function () { toggle('lineHeight'); });
    document.getElementById('a11y-motion')?.addEventListener('click', function () { toggle('reduceMotion'); });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && panelOpen) closePanel();
      if (e.key === 'Tab' && panelOpen) {
        var focusable = Array.prototype.slice.call(getFocusable(panel));
        if (!focusable.length) return;
        var first = focusable[0];
        var last = focusable[focusable.length - 1];
        if (e.shiftKey && document.activeElement === first) {
          e.preventDefault();
          last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
          e.preventDefault();
          first.focus();
        }
      }
    });

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {
      if (state.themePreference === 'system') applyState();
    });

    applyState();
  }

  applyState();

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initWidget);
  } else {
    initWidget();
  }
})();

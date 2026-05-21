(function () {
  try {
    var s = JSON.parse(localStorage.getItem('entrega_ia_a11y') || '{}');
    var pref = s.themePreference || (s.theme === 'dark' ? 'dark' : 'light');
    var h = document.documentElement;
    var theme = pref === 'system'
      ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
      : (pref === 'dark' ? 'dark' : 'light');
    if (theme === 'dark') h.classList.add('a11y-theme-dark');
    else h.classList.add('a11y-theme-light');
    if (s.fontScale > 0) h.classList.add('a11y-font-' + s.fontScale);
    if (s.contrast) h.classList.add('a11y-contrast');
    if (s.grayscale) h.classList.add('a11y-grayscale');
    if (s.underlineLinks) h.classList.add('a11y-underline-links');
    if (s.readableFont) h.classList.add('a11y-readable-font');
    if (s.spacing) h.classList.add('a11y-spacing');
    if (s.lineHeight) h.classList.add('a11y-line-height');
    if (s.reduceMotion) h.classList.add('a11y-reduce-motion');
  } catch (e) { /* ignore */ }
})();

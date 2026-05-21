(function () {
  const STORAGE_KEY = 'entrega_ia_tutoriales';

  function loadProgress() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
    } catch {
      return {};
    }
  }

  function saveProgress(state) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
  }

  document.querySelectorAll('[data-tutorial-id]').forEach(function (checkbox) {
    const id = checkbox.getAttribute('data-tutorial-id');
    const state = loadProgress();
    checkbox.checked = Boolean(state[id]);
    checkbox.addEventListener('change', function () {
      const next = loadProgress();
      next[id] = checkbox.checked;
      saveProgress(next);
    });
  });
})();

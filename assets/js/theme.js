/**
 * GBEST / GBTech - Global Theme Toggle Engine
 * Ultra-reliable theme switcher supporting Dark (Default) & Light modes
 * Persists choice via localStorage and synchronizes across all pages.
 */

(function () {
  'use strict';

  const STORAGE_KEY = 'gbest_theme_preference';
  const htmlRoot = document.documentElement;
  let lastToggleTimestamp = 0;

  function getInitialTheme() {
    try {
      const savedTheme = localStorage.getItem(STORAGE_KEY);
      if (savedTheme === 'light' || savedTheme === 'dark') {
        return savedTheme;
      }
    } catch (e) {}
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
      return 'light';
    }
    return 'dark';
  }

  function applyTheme(theme) {
    if (theme === 'light') {
      htmlRoot.setAttribute('data-theme', 'light');
      if (document.body) document.body.setAttribute('data-theme', 'light');
    } else {
      htmlRoot.removeAttribute('data-theme');
      if (document.body) document.body.removeAttribute('data-theme');
    }
    try {
      localStorage.setItem(STORAGE_KEY, theme);
    } catch (e) {}

    // Update button attributes
    const buttons = document.querySelectorAll('.theme-toggle-btn, #themeToggleBtn, #adminThemeToggle, #loginThemeToggle');
    buttons.forEach(function (btn) {
      btn.setAttribute('aria-label', theme === 'light' ? 'Switch to Dark Mode' : 'Switch to Light Mode');
      btn.setAttribute('title', theme === 'light' ? 'Switch to Dark Mode' : 'Switch to Light Mode');
    });
  }

  // Globally exposed toggle function with anti-bounce protection
  window.toggleTheme = function (e) {
    if (e && e.preventDefault) e.preventDefault();
    if (e && e.stopPropagation) e.stopPropagation();

    const now = Date.now();
    if (now - lastToggleTimestamp < 250) {
      return htmlRoot.getAttribute('data-theme') || 'dark';
    }
    lastToggleTimestamp = now;

    const isLight = htmlRoot.getAttribute('data-theme') === 'light';
    const nextTheme = isLight ? 'dark' : 'light';
    applyTheme(nextTheme);
    return nextTheme;
  };

  // Expose applyTheme globally
  window.applyTheme = applyTheme;

  // Initialize theme immediately on script load
  const initialTheme = getInitialTheme();
  applyTheme(initialTheme);

  // Bind click event listeners when DOM is ready or immediately
  function attachThemeListeners() {
    applyTheme(getInitialTheme());

    const buttons = document.querySelectorAll('.theme-toggle-btn, #themeToggleBtn, #adminThemeToggle, #loginThemeToggle');
    buttons.forEach(function (btn) {
      if (!btn.dataset.themeBound) {
        btn.dataset.themeBound = 'true';
        btn.onclick = function (e) {
          window.toggleTheme(e);
        };
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', attachThemeListeners);
  } else {
    attachThemeListeners();
  }

  // Listen for OS theme changes
  if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
      try {
        if (!localStorage.getItem(STORAGE_KEY)) {
          applyTheme(e.matches ? 'dark' : 'light');
        }
      } catch (err) {}
    });
  }
})();

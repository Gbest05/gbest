/**
 * GBEST / GBTech - Global Theme Toggle Engine
 * Modern theme switcher supporting Dark (Default) & Light modes
 * Persists choice via localStorage and syncs across all pages.
 */

(function () {
  'use strict';

  const STORAGE_KEY = 'gbest_theme_preference';
  const htmlRoot = document.documentElement;

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
    } else {
      htmlRoot.removeAttribute('data-theme');
    }
    try {
      localStorage.setItem(STORAGE_KEY, theme);
    } catch (e) {}

    // Update all theme toggle buttons accessibility attributes
    const buttons = document.querySelectorAll('.theme-toggle-btn, #themeToggleBtn, #adminThemeToggle');
    buttons.forEach(function (btn) {
      btn.setAttribute('aria-label', theme === 'light' ? 'Switch to Dark Mode' : 'Switch to Light Mode');
      btn.setAttribute('title', theme === 'light' ? 'Switch to Dark Mode' : 'Switch to Light Mode');
    });
  }

  // Expose toggleTheme globally
  window.toggleTheme = function () {
    const isLight = htmlRoot.getAttribute('data-theme') === 'light';
    const nextTheme = isLight ? 'dark' : 'light';
    applyTheme(nextTheme);
    return nextTheme;
  };

  // Expose applyTheme globally
  window.applyTheme = applyTheme;

  // Initialize theme immediately
  const initialTheme = getInitialTheme();
  applyTheme(initialTheme);

  // Bind click event listeners via document-level event delegation
  document.addEventListener('click', function (e) {
    const toggleBtn = e.target.closest('.theme-toggle-btn, #themeToggleBtn, #adminThemeToggle');
    if (toggleBtn) {
      e.preventDefault();
      window.toggleTheme();
    }
  });

  // Also bind when DOM is ready
  document.addEventListener('DOMContentLoaded', function () {
    applyTheme(getInitialTheme());
  });

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

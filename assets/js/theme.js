/**
 * GBEST / GBTech - Theme Toggle Engine
 * Modern theme switcher supporting Dark (Default) & Light modes
 * Persists choice via localStorage and detects OS preferences.
 */

(function () {
  'use strict';

  const STORAGE_KEY = 'gbest_theme_preference';
  const themeToggleBtn = document.getElementById('themeToggleBtn');
  const htmlRoot = document.documentElement;

  // Determine initial theme
  function getInitialTheme() {
    const savedTheme = localStorage.getItem(STORAGE_KEY);
    if (savedTheme) {
      return savedTheme;
    }
    // Check OS preference
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
      return 'light';
    }
    return 'dark'; // Default to modern dark
  }

  // Apply theme
  function applyTheme(theme) {
    if (theme === 'light') {
      htmlRoot.setAttribute('data-theme', 'light');
      if (themeToggleBtn) {
        themeToggleBtn.setAttribute('aria-label', 'Switch to Dark Mode');
        themeToggleBtn.setAttribute('title', 'Switch to Dark Mode');
      }
    } else {
      htmlRoot.removeAttribute('data-theme');
      if (themeToggleBtn) {
        themeToggleBtn.setAttribute('aria-label', 'Switch to Light Mode');
        themeToggleBtn.setAttribute('title', 'Switch to Light Mode');
      }
    }
    localStorage.setItem(STORAGE_KEY, theme);
  }

  // Initialize theme immediately to prevent flashing
  const currentTheme = getInitialTheme();
  applyTheme(currentTheme);

  // Bind toggle click event
  if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', function () {
      const activeTheme = htmlRoot.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
      const newTheme = activeTheme === 'light' ? 'dark' : 'light';
      applyTheme(newTheme);
    });
  }

  // Listen for OS theme changes
  if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
      if (!localStorage.getItem(STORAGE_KEY)) {
        applyTheme(e.matches ? 'dark' : 'light');
      }
    });
  }
})();

/**
 * GBEST / GBTech - Theme Toggle Engine
 * Modern theme switcher supporting Dark (Default) & Light modes
 * Persists choice via localStorage and detects OS preferences.
 */

(function () {
  'use strict';

  const STORAGE_KEY = 'gbest_theme_preference';
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

  // Apply theme to document & all toggle buttons
  function applyTheme(theme) {
    if (theme === 'light') {
      htmlRoot.setAttribute('data-theme', 'light');
      document.querySelectorAll('.theme-toggle-btn, #themeToggleBtn').forEach(function (btn) {
        btn.setAttribute('aria-label', 'Switch to Dark Mode');
        btn.setAttribute('title', 'Switch to Dark Mode');
      });
    } else {
      htmlRoot.removeAttribute('data-theme');
      document.querySelectorAll('.theme-toggle-btn, #themeToggleBtn').forEach(function (btn) {
        btn.setAttribute('aria-label', 'Switch to Light Mode');
        btn.setAttribute('title', 'Switch to Light Mode');
      });
    }
    try {
      localStorage.setItem(STORAGE_KEY, theme);
    } catch (e) {}
  }

  // Initialize theme immediately to prevent flashing
  const currentTheme = getInitialTheme();
  applyTheme(currentTheme);

  // Bind toggle click events when DOM is ready or immediately
  function bindToggleButtons() {
    const buttons = document.querySelectorAll('.theme-toggle-btn, #themeToggleBtn');
    buttons.forEach(function (btn) {
      if (!btn.dataset.themeBound) {
        btn.dataset.themeBound = 'true';
        btn.addEventListener('click', function () {
          const activeTheme = htmlRoot.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
          const newTheme = activeTheme === 'light' ? 'dark' : 'light';
          applyTheme(newTheme);
        });
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bindToggleButtons);
  } else {
    bindToggleButtons();
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

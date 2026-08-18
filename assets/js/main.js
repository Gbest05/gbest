/**
 * GBEST / GBTech - Main Application Orchestrator
 * Author: Gbolahan Alade
 * Controls Navigation, Scroll Spy, Mobile Drawer, Scroll Progress, Skills Tabs, and Scroll Reveal.
 */

document.addEventListener('DOMContentLoaded', () => {
  // ------------------------------------------------------------------------
  // 1. NAVBAR SCROLL & SCROLL PROGRESS INDICATOR
  // ------------------------------------------------------------------------
  const navbar = document.getElementById('navbar');
  const scrollProgressBar = document.getElementById('scrollProgressBar');
  const backToTopBtn = document.getElementById('backToTopBtn');

  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollPercent = docHeight > 0 ? (scrollY / docHeight) * 100 : 0;

    // Progress bar
    if (scrollProgressBar) {
      scrollProgressBar.style.width = `${scrollPercent}%`;
    }

    // Navbar shrink
    if (navbar) {
      if (scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }

    // Back to top button
    if (backToTopBtn) {
      if (scrollY > 400) {
        backToTopBtn.classList.add('visible');
      } else {
        backToTopBtn.classList.remove('visible');
      }
    }
  }, { passive: true });

  // Back to top click
  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  // ------------------------------------------------------------------------
  // 2. MOBILE MENU DRAWER & BACKDROP
  // ------------------------------------------------------------------------
  const mobileToggleBtn = document.getElementById('mobileToggleBtn');
  const navMenu = document.getElementById('navMenu');
  const navDrawerBackdrop = document.getElementById('navDrawerBackdrop');

  function openMobileNav() {
    if (navMenu) {
      navMenu.classList.add('open');
      if (navDrawerBackdrop) navDrawerBackdrop.classList.add('active');
      if (mobileToggleBtn) {
        mobileToggleBtn.setAttribute('aria-expanded', 'true');
        mobileToggleBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
      }
      document.body.classList.add('nav-drawer-open');
    }
  }

  function closeMobileNav() {
    if (navMenu) {
      navMenu.classList.remove('open');
      if (navDrawerBackdrop) navDrawerBackdrop.classList.remove('active');
      if (mobileToggleBtn) {
        mobileToggleBtn.setAttribute('aria-expanded', 'false');
        mobileToggleBtn.innerHTML = '<i class="fa-solid fa-bars"></i>';
      }
      document.body.classList.remove('nav-drawer-open');
    }
  }

  if (mobileToggleBtn && navMenu) {
    mobileToggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      if (navMenu.classList.contains('open')) {
        closeMobileNav();
      } else {
        openMobileNav();
      }
    });

    if (navDrawerBackdrop) {
      navDrawerBackdrop.addEventListener('click', closeMobileNav);
    }

    // Close menu when clicking nav links
    const navLinks = navMenu.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        closeMobileNav();
      });
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeMobileNav();
      }
    });
  }

  // ------------------------------------------------------------------------
  // 3. SCROLL SPY - ACTIVE NAVIGATION HIGHLIGHT
  // ------------------------------------------------------------------------
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');

  const scrollSpyObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const currentId = entry.target.getAttribute('id');
        navLinks.forEach(link => {
          if (link.getAttribute('href') === `#${currentId}`) {
            link.classList.add('active');
          } else {
            link.classList.remove('active');
          }
        });
      }
    });
  }, {
    rootMargin: '-20% 0px -70% 0px'
  });

  sections.forEach(section => scrollSpyObserver.observe(section));

  // ------------------------------------------------------------------------
  // 4. SKILLS CATEGORY TABS
  // ------------------------------------------------------------------------
  const skillTabButtons = document.querySelectorAll('.skill-tab-btn');
  const skillTabPanes = document.querySelectorAll('.skills-tab-pane');

  if (skillTabButtons.length && skillTabPanes.length) {
    skillTabButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const targetTab = btn.getAttribute('data-tab');

        skillTabButtons.forEach(b => b.classList.remove('active'));
        skillTabPanes.forEach(p => p.classList.remove('active'));

        btn.classList.add('active');
        const activePane = document.getElementById(targetTab);
        if (activePane) {
          activePane.classList.add('active');
        }
      });
    });
  }

  // ------------------------------------------------------------------------
  // 5. SCROLL REVEAL ANIMATIONS
  // ------------------------------------------------------------------------
  const revealElements = document.querySelectorAll('.reveal-on-scroll');

  const revealObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-revealed');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px'
  });

  revealElements.forEach(el => revealObserver.observe(el));
});

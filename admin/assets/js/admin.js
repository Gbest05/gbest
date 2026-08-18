/**
 * GBEST / GBTech - Admin CMS JavaScript Controller
 * Enhanced Mobile-First Responsive Drawer, Modal & Touch Controller
 */

document.addEventListener('DOMContentLoaded', () => {
  // Mobile Sidebar & Overlay Elements
  const adminMobileToggle = document.getElementById('adminMobileToggle');
  const adminSidebar = document.getElementById('adminSidebar');
  const adminSidebarBackdrop = document.getElementById('adminSidebarBackdrop');
  const adminSidebarClose = document.getElementById('adminSidebarClose');

  function openSidebar() {
    if (adminSidebar) {
      adminSidebar.classList.add('open');
      if (adminSidebarBackdrop) adminSidebarBackdrop.classList.add('active');
      if (adminMobileToggle) adminMobileToggle.setAttribute('aria-expanded', 'true');
      document.body.classList.add('admin-drawer-open');
    }
  }

  function closeSidebar() {
    if (adminSidebar) {
      adminSidebar.classList.remove('open');
      if (adminSidebarBackdrop) adminSidebarBackdrop.classList.remove('active');
      if (adminMobileToggle) adminMobileToggle.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('admin-drawer-open');
    }
  }

  if (adminMobileToggle) {
    adminMobileToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      if (adminSidebar && adminSidebar.classList.contains('open')) {
        closeSidebar();
      } else {
        openSidebar();
      }
    });
  }

  if (adminSidebarBackdrop) {
    adminSidebarBackdrop.addEventListener('click', closeSidebar);
  }

  if (adminSidebarClose) {
    adminSidebarClose.addEventListener('click', closeSidebar);
  }

  // Close sidebar on link click on mobile
  if (adminSidebar) {
    adminSidebar.querySelectorAll('.admin-nav-link').forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 900) {
          closeSidebar();
        }
      });
    });
  }

  // Keyboard accessibility (Escape key closes drawer/modal)
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeSidebar();
      document.querySelectorAll('.admin-modal.active').forEach(modal => {
        modal.classList.remove('active');
        document.body.style.overflow = '';
      });
    }
  });

  // Modal Handlers
  window.openAdminModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      // Focus first input
      const firstInput = modal.querySelector('input:not([type="hidden"]), select, textarea');
      if (firstInput) {
        setTimeout(() => firstInput.focus(), 100);
      }
    }
  };

  window.closeAdminModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  // Close modals when clicking backdrop
  document.querySelectorAll('.admin-modal').forEach(modal => {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  });

  // Image upload real-time preview
  document.querySelectorAll('input[type="file"][data-preview]').forEach(input => {
    input.addEventListener('change', function () {
      const previewTargetId = this.getAttribute('data-preview');
      const previewImg = document.getElementById(previewTargetId);
      if (previewImg && this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
          previewImg.src = e.target.result;
          previewImg.style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
      }
    });
  });
});

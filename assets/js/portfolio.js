/**
 * GBEST / GBTech - Portfolio Filter & Lightbox Engine
 * Handles scoped project & graphics category filtering, responsive lightbox modal, and touch swipe gestures.
 */

document.addEventListener('DOMContentLoaded', () => {
  // ------------------------------------------------------------------------
  // 1. GENERIC SCOPED CATEGORY FILTERING (Projects & Graphics)
  // ------------------------------------------------------------------------
  const filterControlGroups = document.querySelectorAll('.project-filter-controls, .graphics-filter-controls');

  filterControlGroups.forEach(group => {
    const buttons = group.querySelectorAll('.filter-btn');
    const targetSelector = group.getAttribute('data-target') || '.project-item';
    const container = group.closest('.container') || document;
    const targetItems = container.querySelectorAll(targetSelector);

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const selectedFilter = (button.getAttribute('data-filter') || 'all').toLowerCase();

        targetItems.forEach(item => {
          const itemCategories = (item.getAttribute('data-category') || '').toLowerCase();
          const categoryList = itemCategories.split(' ');

          if (selectedFilter === 'all' || categoryList.includes(selectedFilter) || itemCategories.includes(selectedFilter)) {
            item.style.display = 'flex';
            setTimeout(() => {
              item.classList.remove('filtering-out');
              item.classList.add('filtering-in');
            }, 20);
          } else {
            item.classList.remove('filtering-in');
            item.classList.add('filtering-out');
            setTimeout(() => {
              item.style.display = 'none';
            }, 300);
          }
        });
      });
    });
  });

  // ------------------------------------------------------------------------
  // 2. GRAPHICS DESIGN LIGHTBOX MODAL & TOUCH GESTURES
  // ------------------------------------------------------------------------
  const lightboxModal = document.getElementById('lightboxModal');
  const lightboxImage = document.getElementById('lightboxImage');
  const lightboxTitle = document.getElementById('lightboxTitle');
  const lightboxDesc = document.getElementById('lightboxDesc');
  const lightboxCloseBtn = document.getElementById('lightboxCloseBtn');
  const lightboxPrevBtn = document.getElementById('lightboxPrevBtn');
  const lightboxNextBtn = document.getElementById('lightboxNextBtn');

  const getVisibleGraphicCards = () => {
    return Array.from(document.querySelectorAll('.graphic-item-card')).filter(card => {
      return card.style.display !== 'none' && !card.classList.contains('filtering-out');
    });
  };

  let currentGraphicIndex = 0;

  if (lightboxModal) {
    const openLightbox = (index) => {
      const visibleCards = getVisibleGraphicCards();
      if (!visibleCards.length) return;

      currentGraphicIndex = (index + visibleCards.length) % visibleCards.length;
      const targetCard = visibleCards[currentGraphicIndex];
      if (!targetCard) return;

      const imgElem = targetCard.querySelector('.graphic-img');
      const titleElem = targetCard.querySelector('.graphic-item-title');
      const categoryElem = targetCard.querySelector('.graphic-item-category');
      const descElem = targetCard.getAttribute('data-description') || (categoryElem ? categoryElem.textContent : '');

      if (lightboxImage && imgElem) {
        lightboxImage.src = imgElem.src;
        lightboxImage.alt = imgElem.alt || 'Graphics Design Showcase';
      }
      if (lightboxTitle && titleElem) {
        lightboxTitle.textContent = titleElem.textContent;
      }
      if (lightboxDesc) {
        lightboxDesc.textContent = descElem;
      }

      lightboxModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    };

    const closeLightbox = () => {
      lightboxModal.classList.remove('active');
      document.body.style.overflow = '';
    };

    const showNextGraphic = () => {
      openLightbox(currentGraphicIndex + 1);
    };

    const showPrevGraphic = () => {
      openLightbox(currentGraphicIndex - 1);
    };

    // Bind card clicks
    document.addEventListener('click', (e) => {
      const card = e.target.closest('.graphic-item-card');
      if (card) {
        const visibleCards = getVisibleGraphicCards();
        const index = visibleCards.indexOf(card);
        if (index !== -1) {
          openLightbox(index);
        }
      }
    });

    if (lightboxCloseBtn) lightboxCloseBtn.addEventListener('click', closeLightbox);
    if (lightboxNextBtn) lightboxNextBtn.addEventListener('click', showNextGraphic);
    if (lightboxPrevBtn) lightboxPrevBtn.addEventListener('click', showPrevGraphic);

    lightboxModal.addEventListener('click', (e) => {
      if (e.target === lightboxModal || e.target.classList.contains('lightbox-container')) {
        closeLightbox();
      }
    });

    document.addEventListener('keydown', (e) => {
      if (!lightboxModal.classList.contains('active')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') showNextGraphic();
      if (e.key === 'ArrowLeft') showPrevGraphic();
    });

    // Touch Swipe Detection for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    lightboxModal.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    lightboxModal.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      const swipeDistance = touchEndX - touchStartX;
      if (Math.abs(swipeDistance) > 45) {
        if (swipeDistance < 0) {
          showNextGraphic();
        } else {
          showPrevGraphic();
        }
      }
    }, { passive: true });
  }
});

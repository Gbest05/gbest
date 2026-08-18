/**
 * GBEST / GBTech - Viewport Animated Stats Counters
 * Animates numerical values with smooth easing when scrolled into view.
 */

document.addEventListener('DOMContentLoaded', () => {
  const statElements = document.querySelectorAll('.stat-number[data-target]');
  if (!statElements.length) return;

  let hasAnimated = false;

  const animateCounters = () => {
    statElements.forEach(counter => {
      const target = +counter.getAttribute('data-target');
      const suffix = counter.getAttribute('data-suffix') || '';
      const duration = 2000; // 2 seconds
      const startTime = performance.now();

      const updateCounter = (currentTime) => {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Ease out quadratic
        const easeOutQuad = 1 - (1 - progress) * (1 - progress);
        const currentCount = Math.floor(easeOutQuad * target);

        counter.textContent = currentCount + suffix;

        if (progress < 1) {
          requestAnimationFrame(updateCounter);
        } else {
          counter.textContent = target + suffix;
        }
      };

      requestAnimationFrame(updateCounter);
    });
  };

  const observerOptions = {
    threshold: 0.35
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !hasAnimated) {
        hasAnimated = true;
        animateCounters();
        observer.disconnect();
      }
    });
  }, observerOptions);

  const statsSection = document.querySelector('.stats-grid') || statElements[0].closest('section');
  if (statsSection) {
    observer.observe(statsSection);
  }
});

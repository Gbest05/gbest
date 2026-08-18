<?php
/**
 * GBEST / GBTech - Graphics Design Portfolio Dedicated Page
 * Author: Gbolahan Alade
 */

$currentPage = 'graphics';
$pageTitle = 'Graphics Design Portfolio | Gbolahan Alade — GBEST';

require_once __DIR__ . '/includes/header.php';

$graphics = get_graphics();
$pagesContent = get_pages_content();
$pageData = $pagesContent['graphics'] ?? [];
?>

<main>
  <!-- Page Header with Dynamic Hero Background Image -->
  <section class="page-hero-banner" style="background-image: url('<?php echo htmlspecialchars($pageData['hero_bg_image'] ?? 'assets/images/hero-bgs/graphics-hero.svg'); ?>');">
    <div class="container" style="text-align: center;">
      <span class="badge-tag" style="background: rgba(236, 72, 153, 0.12); border-color: rgba(236, 72, 153, 0.3); color: #EC4899;">
        <?php echo htmlspecialchars($pageData['badge'] ?? 'Visual Artistry'); ?>
      </span>
      <h1 class="section-title" style="font-size: clamp(2rem, 5vw, 3rem); margin-top: 0.5rem;">
        <span class="animated-gradient-text"><?php echo htmlspecialchars($pageData['title'] ?? 'Graphics & Brand Design Portfolio'); ?></span>
      </h1>
      <p class="section-subtitle" style="max-width: 680px; margin: 0 auto;">
        <?php echo htmlspecialchars($pageData['subtitle'] ?? 'Promotional flyers, brand identities, typography posters, and social media creative campaigns. Click any artwork to view in high resolution.'); ?>
      </p>
    </div>
  </section>

  <!-- Graphics Portfolio & Category Filter Section -->
  <section class="section-spacing" style="padding-top: 2rem;">
    <div class="container">
      <!-- Interactive Graphics Category Filter Tabs -->
      <div class="graphics-filter-controls" data-target=".graphic-item-card" style="display: flex; justify-content: center; flex-wrap: wrap; gap: 0.55rem; margin-bottom: 2.5rem;">
        <button class="filter-btn active" data-filter="all">All Artwork (<?php echo count($graphics); ?>)</button>
        <button class="filter-btn" data-filter="flyers"><i class="fa-solid fa-file-lines" style="margin-right: 4px;"></i> Flyers &amp; Print</button>
        <button class="filter-btn" data-filter="branding"><i class="fa-solid fa-copyright" style="margin-right: 4px;"></i> Branding &amp; Identity</button>
        <button class="filter-btn" data-filter="social"><i class="fa-solid fa-hashtag" style="margin-right: 4px;"></i> Social Media</button>
        <button class="filter-btn" data-filter="posters"><i class="fa-solid fa-image" style="margin-right: 4px;"></i> Posters &amp; Typography</button>
        <button class="filter-btn" data-filter="logos"><i class="fa-solid fa-vector-square" style="margin-right: 4px;"></i> Logos &amp; Marks</button>
        <button class="filter-btn" data-filter="business"><i class="fa-solid fa-briefcase" style="margin-right: 4px;"></i> Business &amp; Editorial</button>
        <button class="filter-btn" data-filter="event"><i class="fa-solid fa-ticket" style="margin-right: 4px;"></i> Events</button>
      </div>

      <!-- Graphics Masonry Grid -->
      <div class="graphics-masonry-grid">
        <?php foreach ($graphics as $gfx): ?>
          <div class="graphic-item-card project-item reveal-on-scroll" data-category="<?php echo htmlspecialchars($gfx['category'] ?? 'flyers'); ?>" data-description="<?php echo htmlspecialchars($gfx['description'] ?? ''); ?> (Client: <?php echo htmlspecialchars($gfx['client'] ?? 'GBEST'); ?>)">
            <img src="<?php echo htmlspecialchars($gfx['image']); ?>" alt="<?php echo htmlspecialchars($gfx['title']); ?>" class="graphic-img" loading="lazy">
            <div class="graphic-overlay-info">
              <span class="graphic-item-category"><?php echo htmlspecialchars($gfx['category_label'] ?? $gfx['category']); ?></span>
              <h3 class="graphic-item-title"><?php echo htmlspecialchars($gfx['title']); ?></h3>
              <span class="graphic-item-view-btn"><i class="fa-solid fa-expand"></i> Click to Zoom</span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- CTA Card -->
      <div style="text-align: center; margin-top: 4.5rem; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--radius-xl); padding: clamp(2rem, 4vw, 3rem) clamp(1.25rem, 3vw, 2rem);">
        <h2 style="font-size: clamp(1.4rem, 3.5vw, 1.85rem); margin-bottom: 0.75rem;">
          <?php echo htmlspecialchars($pageData['cta_heading'] ?? 'Need World-Class Branding or Flyers?'); ?>
        </h2>
        <p style="color: var(--text-secondary); max-width: 540px; margin: 0 auto 1.5rem auto; font-size: 0.95rem;">
          <?php echo htmlspecialchars($pageData['cta_text'] ?? "From logo design to complete corporate marketing kits, let's create visuals that elevate your brand."); ?>
        </p>
        <a href="contact.php" class="btn btn-primary">
          <span>Request a Design Quote</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- Lightbox Modal Container -->
  <div id="lightboxModal" class="lightbox-modal" role="dialog" aria-modal="true" aria-label="Artwork Preview">
    <div class="lightbox-container modal-content-anim">
      <button id="lightboxCloseBtn" class="lightbox-close-btn" aria-label="Close Lightbox"><i class="fa-solid fa-xmark"></i></button>
      <button id="lightboxPrevBtn" class="lightbox-nav-btn lightbox-prev" aria-label="Previous artwork"><i class="fa-solid fa-chevron-left"></i></button>
      <button id="lightboxNextBtn" class="lightbox-nav-btn lightbox-next" aria-label="Next artwork"><i class="fa-solid fa-chevron-right"></i></button>
      
      <div class="lightbox-media-wrap">
        <img id="lightboxImage" src="" alt="Artwork Preview">
      </div>
      <div class="lightbox-caption">
        <h3 id="lightboxTitle" class="lightbox-title"></h3>
        <p id="lightboxDesc" class="lightbox-desc"></p>
      </div>
    </div>
  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<?php
/**
 * GBEST / GBTech - All Projects Showcase Dedicated Page
 * Author: Gbolahan Alade
 */

$currentPage = 'projects';
$pageTitle = 'Projects Portfolio | Gbolahan Alade — GBEST';

require_once __DIR__ . '/includes/header.php';

$projects = get_projects();
$pagesContent = get_pages_content();
$pageData = $pagesContent['projects'] ?? [];
?>

<main>
  <!-- Page Header with Dynamic Hero Background Image -->
  <section class="page-hero-banner" style="background-image: url('<?php echo htmlspecialchars($pageData['hero_bg_image'] ?? 'assets/images/hero-bgs/projects-hero.svg'); ?>');">
    <div class="container" style="text-align: center;">
      <span class="badge-tag"><?php echo htmlspecialchars($pageData['badge'] ?? 'Portfolio'); ?></span>
      <h1 class="section-title" style="font-size: clamp(2rem, 5vw, 3rem); margin-top: 0.5rem;">
        <span class="animated-gradient-text"><?php echo htmlspecialchars($pageData['title'] ?? 'Featured Web & Software Projects'); ?></span>
      </h1>
      <p class="section-subtitle" style="max-width: 680px; margin: 0 auto;">
        <?php echo htmlspecialchars($pageData['subtitle'] ?? 'Explore real-world software applications, academic portals, full-stack systems, and machine learning models.'); ?>
      </p>
    </div>
  </section>

  <!-- Filter & Projects Grid -->
  <section class="section-spacing" style="padding-top: 1rem;">
    <div class="container">
      <!-- Filter Controls -->
      <div class="project-filter-controls reveal-on-scroll">
        <button class="filter-btn active" data-filter="all">All Projects (<?php echo count($projects); ?>)</button>
        <button class="filter-btn" data-filter="web">Web Development</button>
        <button class="filter-btn" data-filter="ai">AI &amp; Machine Learning</button>
        <button class="filter-btn" data-filter="software">Software Systems</button>
        <button class="filter-btn" data-filter="ui">UI/UX Design</button>
      </div>

      <!-- Projects Grid -->
      <div class="projects-grid">
        <?php foreach ($projects as $proj): ?>
          <article class="project-card project-item reveal-on-scroll" data-category="<?php echo htmlspecialchars($proj['category']); ?>">
            <div class="project-image-wrap">
              <img src="<?php echo htmlspecialchars($proj['image']); ?>" alt="<?php echo htmlspecialchars($proj['title']); ?>" class="project-img" loading="lazy">
              <span class="project-category-badge"><?php echo htmlspecialchars($proj['category_label'] ?? $proj['category']); ?></span>
            </div>
            <div class="project-body">
              <h3 class="project-title"><?php echo htmlspecialchars($proj['title']); ?></h3>
              <p class="project-desc"><?php echo htmlspecialchars($proj['description']); ?></p>
              
              <div class="project-tech-tags">
                <?php foreach ($proj['technologies'] ?? [] as $t): ?>
                  <span class="tech-tag"><?php echo htmlspecialchars($t); ?></span>
                <?php endforeach; ?>
              </div>

              <div class="project-actions">
                <?php 
                  $isAccessAllowed = !isset($proj['allow_request_access']) || $proj['allow_request_access'] === true || $proj['allow_request_access'] === '1' || $proj['allow_request_access'] === 1;
                ?>
                <?php if (!empty($proj['demo_url']) && $isAccessAllowed): ?>
                  <a href="<?php echo htmlspecialchars($proj['demo_url']); ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8125rem;">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span><?php echo htmlspecialchars(!empty($proj['request_access_label']) ? $proj['request_access_label'] : 'View Demo'); ?></span>
                  </a>
                <?php endif; ?>

                <?php if (!empty($proj['github_url'])): ?>
                  <a href="<?php echo htmlspecialchars($proj['github_url']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.8125rem;">
                    <i class="fa-brands fa-github"></i>
                    <span>Code</span>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <div style="text-align: center; margin-top: 4.5rem; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--radius-xl); padding: 3rem 2rem;">
        <h2 style="font-size: 1.85rem; margin-bottom: 0.75rem;">Have a Custom Project in Mind?</h2>
        <p style="color: var(--text-secondary); max-width: 540px; margin: 0 auto 1.5rem auto;">Let's collaborate to build your web platform, AI tool, or custom enterprise software solution.</p>
        <a href="contact.php" class="btn btn-primary">
          <span>Let's Discuss Requirements</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

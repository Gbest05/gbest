<?php
/**
 * GBEST / GBTech - Web Development Portfolio Dedicated Page
 * Author: Gbolahan Alade
 */

$currentPage = 'webdev';
$pageTitle = 'Web Development Portfolio | Gbolahan Alade — GBEST';

require_once __DIR__ . '/includes/header.php';

$webProjects = get_projects('web');
$allProjects = get_projects();
$displayProjects = !empty($webProjects) ? $webProjects : $allProjects;
$pagesContent = get_pages_content();
$pageData = $pagesContent['webdev'] ?? [];
?>

<main>
  <!-- Page Header with Dynamic Hero Background Image -->
  <section class="page-hero-banner" style="background-image: url('<?php echo htmlspecialchars($pageData['hero_bg_image'] ?? 'assets/images/hero-bgs/webdev-hero.svg'); ?>');">
    <div class="container" style="text-align: center;">
      <span class="badge-tag cyan"><?php echo htmlspecialchars($pageData['badge'] ?? 'Engineering Standards'); ?></span>
      <h1 class="section-title" style="font-size: clamp(2rem, 5vw, 3rem); margin-top: 0.5rem;">
        <span class="animated-gradient-text"><?php echo htmlspecialchars($pageData['title'] ?? 'Web Applications & Platforms'); ?></span>
      </h1>
      <p class="section-subtitle" style="max-width: 680px; margin: 0 auto;">
        <?php echo htmlspecialchars($pageData['subtitle'] ?? 'Full-stack platforms built with semantic HTML5, CSS3, JavaScript, PHP 8+, and PostgreSQL databases. Explore live browser mockup previews.'); ?>
      </p>
    </div>
  </section>

  <!-- Web Dev Browser Mockups Grid -->
  <section class="section-spacing" style="padding-top: 1rem;">
    <div class="container">
      <div class="browser-mockups-grid">
        <?php foreach ($displayProjects as $proj): ?>
          <div class="browser-mockup-card reveal-on-scroll">
            <div class="browser-mockup-header">
              <div class="browser-dots">
                <span class="browser-dot red"></span>
                <span class="browser-dot yellow"></span>
                <span class="browser-dot green"></span>
              </div>
              <div class="browser-address-bar">https://<?php echo strtolower(preg_replace('/[^a-z0-9]/i', '-', $proj['title'])); ?>.gbest.tech/live</div>
            </div>

            <div class="browser-preview-frame">
              <img src="<?php echo htmlspecialchars($proj['image']); ?>" alt="<?php echo htmlspecialchars($proj['title']); ?>">
            </div>

            <div class="browser-details-body">
              <span class="badge-tag cyan" style="font-size: 0.75rem; padding: 0.2rem 0.6rem;"><?php echo htmlspecialchars($proj['category_label'] ?? 'Full-Stack Web'); ?></span>
              <h3 style="font-size: 1.35rem; margin: 0.5rem 0;"><?php echo htmlspecialchars($proj['title']); ?></h3>
              <p style="font-size: 0.9375rem; color: var(--text-secondary); margin-bottom: 1.25rem;"><?php echo htmlspecialchars($proj['description']); ?></p>
              
              <div class="project-tech-tags" style="margin-bottom: 1.25rem;">
                <?php foreach ($proj['technologies'] ?? [] as $t): ?>
                  <span class="tech-tag"><?php echo htmlspecialchars($t); ?></span>
                <?php endforeach; ?>
              </div>

              <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
                <?php 
                  $isAccessAllowed = !isset($proj['allow_request_access']) || $proj['allow_request_access'] === true || $proj['allow_request_access'] === '1' || $proj['allow_request_access'] === 1;
                  $rawTarget = !empty($proj['demo_url']) ? $proj['demo_url'] : (!empty($proj['request_access_url']) ? $proj['request_access_url'] : 'contact.php');
                  $targetUrl = format_url($rawTarget);
                  $isExternal = str_starts_with($targetUrl, 'http://') || str_starts_with($targetUrl, 'https://');
                  $btnLabel = !empty($proj['request_access_label']) ? $proj['request_access_label'] : ($isExternal ? 'Live Access Server' : 'Request Live Access');
                ?>
                <?php if ($isAccessAllowed): ?>
                  <a href="<?php echo htmlspecialchars($targetUrl); ?>" <?php echo $isExternal ? 'target="_blank" rel="noopener noreferrer"' : ''; ?> class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span><?php echo htmlspecialchars($btnLabel); ?></span>
                  </a>
                <?php endif; ?>

                <?php if (!empty($proj['github_url'])): ?>
                  <a href="<?php echo htmlspecialchars(format_url($proj['github_url'])); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">
                    <i class="fa-brands fa-github"></i>
                    <span>View Repository</span>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Web Dev Philosophy Box -->
      <div style="margin-top: 4.5rem; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--radius-xl); padding: 3rem 2.5rem;" class="reveal-on-scroll">
        <div class="section-header" style="margin-bottom: 2rem;">
          <span class="badge-tag">Standards</span>
          <h2 class="section-title" style="font-size: 2rem;">Full-Stack Development Standards</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
          <div class="stat-card" style="text-align: left; padding: 1.75rem;">
            <i class="fa-solid fa-gauge-high fa-2x" style="color: var(--accent-emerald); margin-bottom: 1rem;"></i>
            <h3 style="font-size: 1.15rem; margin-bottom: 0.4rem;">Performance &amp; Speed</h3>
            <p style="font-size: 0.875rem; color: var(--text-muted);">Optimized DOM trees, minimal JavaScript runtime overhead, asset caching, and 90+ Lighthouse targets.</p>
          </div>

          <div class="stat-card" style="text-align: left; padding: 1.75rem;">
            <i class="fa-solid fa-database fa-2x" style="color: var(--accent-cyan); margin-bottom: 1rem;"></i>
            <h3 style="font-size: 1.15rem; margin-bottom: 0.4rem;">Database Scalability</h3>
            <p style="font-size: 0.875rem; color: var(--text-muted);">Structured relational schemas, foreign key constraints, parameterized SQL queries, and robust connection pooling.</p>
          </div>

          <div class="stat-card" style="text-align: left; padding: 1.75rem;">
            <i class="fa-solid fa-lock fa-2x" style="color: var(--accent-purple); margin-bottom: 1rem;"></i>
            <h3 style="font-size: 1.15rem; margin-bottom: 0.4rem;">Security &amp; Sanitization</h3>
            <p style="font-size: 0.875rem; color: var(--text-muted);">CSRF verification, XSS protection headers, bcrypt password hashing, and strict input validation layers.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

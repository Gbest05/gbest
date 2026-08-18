<?php
/**
 * GBEST / GBTech - About Me Dedicated Page
 * Author: Gbolahan Alade
 */

$currentPage = 'about';
$pageTitle = 'About Gbolahan Alade | Graphics Designer, Web Developer & AI Enthusiast — GBEST';

require_once __DIR__ . '/includes/header.php';

$pagesContent = get_pages_content();
$pageData = $pagesContent['about'] ?? [];
?>

<main>
  <!-- Page Hero Banner with Dynamic Background Image -->
  <section class="page-hero-banner" style="background-image: url('<?php echo htmlspecialchars($pageData['hero_bg_image'] ?? 'assets/images/hero-bgs/about-hero.svg'); ?>');">
    <div class="container text-center" style="text-align: center;">
      <span class="badge-tag"><?php echo htmlspecialchars($pageData['badge'] ?? 'Who I Am'); ?></span>
      <h1 class="section-title" style="font-size: clamp(2rem, 5vw, 3rem); margin-top: 0.5rem;">
        <span class="animated-gradient-text"><?php echo htmlspecialchars($pageData['title'] ?? 'About Gbolahan Alade'); ?></span>
      </h1>
      <p class="section-subtitle" style="max-width: 680px; margin: 0 auto;">
        <?php echo htmlspecialchars($pageData['subtitle'] ?? 'Creative Technologist uniting visual brand design, full-stack software development, and artificial intelligence.'); ?>
      </p>
    </div>
  </section>

  <!-- Bio & Stats Section -->
  <section class="section-spacing" style="padding-top: 1.5rem;">
    <div class="container">
      <div class="about-grid">
        <!-- Visual Column -->
        <div class="reveal-on-scroll">
          <div class="hero-avatar-card shimmer-effect" style="width: 100%; max-width: 420px; height: 480px; margin: 0 auto;">
            <div class="avatar-inner-frame">
              <img src="<?php echo htmlspecialchars($siteConfig['profile_image']); ?>" alt="<?php echo htmlspecialchars($siteConfig['owner_name']); ?>" class="avatar-img">
              <div class="avatar-status-badge">
                <span class="status-dot"></span>
                <span><?php echo htmlspecialchars($siteConfig['professional_title']); ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Narrative Column -->
        <div class="about-text-content reveal-on-scroll reveal-delay-1">
          <h2 style="font-size: clamp(1.4rem, 3.5vw, 2rem); margin-bottom: 1.25rem;">
            <?php echo htmlspecialchars($pageData['story_heading'] ?? 'Designing Ideas. Building Technology. Creating Impact.'); ?>
          </h2>
          <p><?php echo htmlspecialchars($pageData['bio_1'] ?? $siteConfig['about_bio_1']); ?></p>
          <p><?php echo htmlspecialchars($pageData['bio_2'] ?? $siteConfig['about_bio_2']); ?></p>
          <p><?php echo htmlspecialchars($pageData['bio_3'] ?? 'Whether designing high-conversion corporate brand identities, architecting database-driven web platforms, or training natural language processing models, my goal remains consistent: creating functional, beautiful, and intelligent solutions that solve complex problems.'); ?></p>

          <!-- Highlights Grid -->
          <div class="about-highlights" style="margin-top: 2rem;">
            <div class="highlight-item">
              <i class="fa-solid fa-pen-nib fa-lg"></i>
              <div>
                <div class="highlight-title">Visual Identity &amp; Branding</div>
                <div class="highlight-desc">Flyers, vector logos, editorial layouts &amp; UI designs.</div>
              </div>
            </div>
            <div class="highlight-item">
              <i class="fa-solid fa-code fa-lg"></i>
              <div>
                <div class="highlight-title">Full-Stack Architecture</div>
                <div class="highlight-desc">PHP 8+, PostgreSQL, REST APIs &amp; Docker systems.</div>
              </div>
            </div>
            <div class="highlight-item">
              <i class="fa-solid fa-brain fa-lg"></i>
              <div>
                <div class="highlight-title">Artificial Intelligence</div>
                <div class="highlight-desc">BERT NLP transformers, predictive models &amp; bots.</div>
              </div>
            </div>
            <div class="highlight-item">
              <i class="fa-solid fa-shield-halved fa-lg"></i>
              <div>
                <div class="highlight-title">Production Quality</div>
                <div class="highlight-desc">Secure, accessible, mobile-first, and high-performance.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Animated Stats Cards -->
      <div class="stats-grid reveal-on-scroll" style="margin-top: 4.5rem;">
        <div class="stat-card">
          <div class="stat-icon"><i class="fa-solid fa-cubes-stacked fa-xl"></i></div>
          <div class="stat-number" data-target="<?php echo htmlspecialchars($siteConfig['stats']['projects_completed']); ?>" data-suffix="+">0</div>
          <div class="stat-label">Projects Completed</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background: rgba(6, 182, 212, 0.12); color: var(--accent-cyan);"><i class="fa-solid fa-microchip fa-xl"></i></div>
          <div class="stat-number" data-target="<?php echo htmlspecialchars($siteConfig['stats']['technologies']); ?>" data-suffix="+">0</div>
          <div class="stat-label">Technologies Mastered</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background: rgba(245, 158, 11, 0.12); color: var(--accent-amber);"><i class="fa-solid fa-timeline fa-xl"></i></div>
          <div class="stat-number" data-target="<?php echo htmlspecialchars($siteConfig['stats']['years_experience']); ?>" data-suffix="+">0</div>
          <div class="stat-label">Years of Experience</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background: rgba(16, 185, 129, 0.12); color: var(--accent-emerald);"><i class="fa-solid fa-users fa-xl"></i></div>
          <div class="stat-number" data-target="<?php echo htmlspecialchars($siteConfig['stats']['happy_clients']); ?>" data-suffix="+">0</div>
          <div class="stat-label">Happy Clients &amp; Users</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Journey Timeline Section -->
  <section class="section-spacing" style="background: var(--bg-surface-elevated);">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag cyan">Evolution</span>
        <h2 class="section-title">My Professional Journey</h2>
        <p class="section-subtitle">A chronological overview of milestones, skill acquisition, and technical leadership.</p>
      </div>

      <div class="timeline-wrap">
        <div class="timeline-node reveal-on-scroll">
          <div class="timeline-marker"><i class="fa-solid fa-palette"></i></div>
          <div class="timeline-content-box">
            <span class="timeline-date-tag">Phase 1 • Creative Foundations</span>
            <h3 class="timeline-title">Graphics &amp; Brand Designer</h3>
            <p class="timeline-desc">Mastered Adobe Photoshop, CorelDRAW, typography, visual hierarchy, print design, and corporate brand identity creation.</p>
          </div>
        </div>

        <div class="timeline-node reveal-on-scroll reveal-delay-1">
          <div class="timeline-marker"><i class="fa-solid fa-code"></i></div>
          <div class="timeline-content-box">
            <span class="timeline-date-tag">Phase 2 • Web &amp; Frontend</span>
            <h3 class="timeline-title">Frontend &amp; Web Developer</h3>
            <p class="timeline-desc">Engineered responsive HTML5, CSS3, JavaScript, and Bootstrap interfaces. Focused on user experience and cross-browser consistency.</p>
          </div>
        </div>

        <div class="timeline-node reveal-on-scroll">
          <div class="timeline-marker"><i class="fa-solid fa-database"></i></div>
          <div class="timeline-content-box">
            <span class="timeline-date-tag">Phase 3 • Full-Stack Systems</span>
            <h3 class="timeline-title">Full-Stack Software Developer</h3>
            <p class="timeline-desc">Developed database-driven web platforms with PHP, PostgreSQL, RESTful APIs, Git version control, Docker, and Render cloud deployments.</p>
          </div>
        </div>

        <div class="timeline-node reveal-on-scroll reveal-delay-1">
          <div class="timeline-marker"><i class="fa-solid fa-brain"></i></div>
          <div class="timeline-content-box">
            <span class="timeline-date-tag">Phase 4 • Artificial Intelligence</span>
            <h3 class="timeline-title">AI &amp; Machine Learning Specialist</h3>
            <p class="timeline-desc">Developed NLP solutions, BERT transformers for intelligent tutoring, student grade regression models, and computer vision systems.</p>
          </div>
        </div>

        <div class="timeline-node reveal-on-scroll">
          <div class="timeline-marker"><i class="fa-solid fa-rocket"></i></div>
          <div class="timeline-content-box">
            <span class="timeline-date-tag">Present &amp; Future</span>
            <h3 class="timeline-title">Creative Technologist (GBEST / GBTech)</h3>
            <p class="timeline-desc">Building scalable, intelligent digital products for institutions, enterprises, and innovators worldwide.</p>
          </div>
        </div>
      </div>

      <div style="text-align: center; margin-top: 3.5rem;">
        <a href="contact.php" class="btn btn-primary">
          <span>Let's Discuss a Project</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

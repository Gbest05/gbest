<?php
/**
 * GBEST / GBTech - Modern Personal Portfolio Landing Page
 * Author: Gbolahan Alade
 */

$currentPage = 'home';
require_once __DIR__ . '/includes/header.php';

$projects = get_projects();
$graphics = get_graphics();
$pagesContent = get_pages_content();
$homeData = $pagesContent['home'] ?? [];
$gfxData = $pagesContent['graphics'] ?? [];
?>

<main>
  <!-- =========================================================================
       1. HERO SECTION
       ========================================================================= -->
  <section id="home" class="hero-section" style="background-image: url('<?php echo htmlspecialchars($homeData['hero_bg_image'] ?? 'assets/images/hero-bgs/home-hero.svg'); ?>'); background-size: cover; background-position: center;">
    <div class="hero-bg-overlay"></div>
    <div class="hero-grid-pattern"></div>

    <div class="container">
      <div class="hero-content-grid">
        <!-- Left Column -->
        <div class="hero-text-column reveal-on-scroll">
          <div class="hero-intro-badge">
            <span class="status-dot"></span>
            <span><?php echo htmlspecialchars($homeData['badge'] ?? $siteConfig['hero_badge']); ?></span>
          </div>

          <h1 class="hero-title">
            <?php echo htmlspecialchars($homeData['title_prefix'] ?? $siteConfig['hero_title_prefix']); ?> <span class="animated-gradient-text"><?php echo htmlspecialchars($homeData['title_name'] ?? $siteConfig['owner_name']); ?></span>
          </h1>

          <!-- Hero Typewriter Animation -->
          <div class="hero-typewriter-container" aria-live="polite">
            <span class="typewriter-prefix">I am a</span>
            <span id="typewriterText" class="typewriter-text" data-roles='<?php echo json_encode($siteConfig['typewriter_roles'] ?? []); ?>'></span>
            <span class="typewriter-cursor">|</span>
          </div>

          <p class="hero-description">
            <?php echo htmlspecialchars($homeData['description'] ?? $siteConfig['hero_description']); ?>
          </p>

          <!-- Hero CTA Buttons -->
          <div class="hero-cta-group">
            <a href="<?php echo htmlspecialchars($homeData['cta_primary_url'] ?? 'projects.php'); ?>" class="btn btn-primary">
              <i class="fa-solid fa-layer-group"></i>
              <span><?php echo htmlspecialchars($homeData['cta_primary_text'] ?? 'View My Work'); ?></span>
            </a>
            <a href="contact.php" class="btn btn-secondary">
              <i class="fa-solid fa-file-arrow-down"></i>
              <span>Download CV</span>
            </a>
            <a href="<?php echo htmlspecialchars($homeData['cta_secondary_url'] ?? 'contact.php'); ?>" class="btn btn-outline-cyan">
              <i class="fa-solid fa-paper-plane"></i>
              <span><?php echo htmlspecialchars($homeData['cta_secondary_text'] ?? "Let's Connect"); ?></span>
            </a>
          </div>

          <!-- Social Mini Bar -->
          <div class="hero-social-bar">
            <span style="font-size: 0.8125rem; color: var(--text-muted); margin-right: 0.5rem;">Connect with me:</span>
            <a href="<?php echo htmlspecialchars($siteConfig['socials']['github']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
            <a href="<?php echo htmlspecialchars($siteConfig['socials']['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="<?php echo htmlspecialchars($siteConfig['socials']['twitter']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="<?php echo htmlspecialchars($siteConfig['socials']['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="<?php echo htmlspecialchars($siteConfig['contact']['whatsapp_url']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
        </div>

        <!-- Right Column Avatar Card -->
        <div class="hero-visual-wrapper reveal-on-scroll reveal-delay-2">
          <div class="hero-avatar-card shimmer-effect">
            <div class="avatar-inner-frame">
              <img src="<?php echo htmlspecialchars($siteConfig['profile_image']); ?>" alt="<?php echo htmlspecialchars($siteConfig['owner_name']); ?>" class="avatar-img">
              <div class="avatar-status-badge">
                <span class="status-dot"></span>
                <span>Innovating with Code &amp; Creativity</span>
              </div>
            </div>
          </div>

          <!-- Floating Tech Chips -->
          <div class="floating-tech-chip chip-1 floating-elem">
            <i class="fa-brands fa-python" style="color: #38BDF8;"></i>
            <span>Python &amp; AI</span>
          </div>
          <div class="floating-tech-chip chip-2 floating-elem-reverse">
            <i class="fa-brands fa-php" style="color: #8B5CF6;"></i>
            <span>Full-Stack Web</span>
          </div>
          <div class="floating-tech-chip chip-3 floating-elem">
            <i class="fa-brands fa-figma" style="color: #F43F5E;"></i>
            <span>UI/UX &amp; Graphics</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       2. ABOUT SECTION
       ========================================================================= -->
  <section id="about" class="section-spacing">
    <div class="container">
      <div class="about-grid">
        <!-- Text Column -->
        <div class="about-text-content reveal-on-scroll">
          <span class="badge-tag">About Me</span>
          <h2 class="section-title">Bridging Code, Artistry &amp; Deep Intelligence</h2>
          <p><?php echo htmlspecialchars($siteConfig['about_bio_1']); ?></p>
          <p><?php echo htmlspecialchars($siteConfig['about_bio_2']); ?></p>

          <!-- Highlights Grid -->
          <div class="about-highlights">
            <div class="highlight-item">
              <i class="fa-solid fa-palette fa-lg"></i>
              <div>
                <div class="highlight-title">Graphics &amp; Brand Design</div>
                <div class="highlight-desc">Brand kits, vector flyers, modern logos &amp; social assets.</div>
              </div>
            </div>
            <div class="highlight-item">
              <i class="fa-solid fa-code fa-lg"></i>
              <div>
                <div class="highlight-title">Robust Architecture</div>
                <div class="highlight-desc">Clean, maintainable web applications &amp; databases.</div>
              </div>
            </div>
            <div class="highlight-item">
              <i class="fa-solid fa-brain fa-lg"></i>
              <div>
                <div class="highlight-title">AI &amp; Neural Models</div>
                <div class="highlight-desc">NLP, BERT transformers, predictors &amp; chatbots.</div>
              </div>
            </div>
            <div class="highlight-item">
              <i class="fa-solid fa-bolt fa-lg"></i>
              <div>
                <div class="highlight-title">Fast Performance</div>
                <div class="highlight-desc">Zero bloat, accessible, and 90+ Lighthouse targets.</div>
              </div>
            </div>
          </div>

          <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="about.php" class="btn btn-primary">
              <span>Read Full Story</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="skills.php" class="btn btn-secondary">
              <span>Explore My Tech Stack</span>
              <i class="fa-solid fa-code"></i>
            </a>
          </div>
        </div>

        <!-- Animated Stat Counters -->
        <div class="stats-grid reveal-on-scroll reveal-delay-2">
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
    </div>
  </section>

  <!-- =========================================================================
       3. SERVICES & DISCIPLINES
       ========================================================================= -->
  <section id="services" class="section-spacing" style="background: var(--bg-surface-elevated);">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag cyan">What I Do</span>
        <h2 class="section-title">Comprehensive Tech &amp; Design Services</h2>
        <p class="section-subtitle">Delivering end-to-end digital solutions from corporate brand identities to production-grade web systems and AI architectures.</p>
      </div>

      <div class="services-grid">
        <!-- Service 1: Graphic Design -->
        <div class="service-card reveal-on-scroll">
          <div class="service-icon-box"><i class="fa-solid fa-palette fa-2xl"></i></div>
          <h3 class="service-title">Graphics &amp; Brand Design</h3>
          <p class="service-desc">Transforming brand vision into compelling visual narratives. Creating premium marketing collaterals, event flyers, and vector brand kits.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> Corporate Brand Identity &amp; Logos</li>
            <li><i class="fa-solid fa-circle-check"></i> High-Impact Event &amp; Church Flyers</li>
            <li><i class="fa-solid fa-circle-check"></i> Social Media Marketing Kits</li>
            <li><i class="fa-solid fa-circle-check"></i> Print-Ready Editorial Layouts</li>
          </ul>
        </div>

        <!-- Service 2: Web Development -->
        <div class="service-card reveal-on-scroll reveal-delay-1">
          <div class="service-icon-box" style="background: rgba(6, 182, 212, 0.12); color: var(--accent-cyan);"><i class="fa-solid fa-code fa-2xl"></i></div>
          <h3 class="service-title">Web &amp; Software Development</h3>
          <p class="service-desc">Building scalable, secure web applications, database architectures, and RESTful APIs optimized for speed, usability, and maintainability.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> Responsive Full-Stack Platforms</li>
            <li><i class="fa-solid fa-circle-check"></i> PHP 8, MySQL &amp; PostgreSQL Databases</li>
            <li><i class="fa-solid fa-circle-check"></i> Secure Authentication &amp; Role Access</li>
            <li><i class="fa-solid fa-circle-check"></i> Docker &amp; Cloud Deployments (Render)</li>
          </ul>
        </div>

        <!-- Service 3: AI Solutions -->
        <div class="service-card reveal-on-scroll reveal-delay-2">
          <div class="service-icon-box" style="background: rgba(245, 158, 11, 0.12); color: var(--accent-amber);"><i class="fa-solid fa-brain fa-2xl"></i></div>
          <h3 class="service-title">AI &amp; Machine Learning</h3>
          <p class="service-desc">Developing intelligent systems that extract insights, automate workflows, and deliver conversational AI experiences powered by deep learning.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> Natural Language Processing (NLP)</li>
            <li><i class="fa-solid fa-circle-check"></i> BERT Transformers &amp; Classifiers</li>
            <li><i class="fa-solid fa-circle-check"></i> Predictive Machine Learning Models</li>
            <li><i class="fa-solid fa-circle-check"></i> Interactive Conversational Bots</li>
          </ul>
        </div>
      </div>

      <div style="text-align: center; margin-top: 3.5rem;">
        <a href="services.php" class="btn btn-secondary" style="border-color: var(--accent-purple);">
          <span>View All Service Offerings</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       4. FEATURED PROJECTS SHOWCASE
       ========================================================================= -->
  <section id="projects" class="section-spacing">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag">Selected Works</span>
        <h2 class="section-title">Web &amp; Software Projects</h2>
        <p class="section-subtitle">Real-world applications built with high engineering standards, clean architecture, and intuitive user experiences.</p>
      </div>

      <!-- Project Filter Bar -->
      <div class="project-filter-controls" data-target=".project-item">
        <button class="filter-btn active" data-filter="all">All Projects</button>
        <button class="filter-btn" data-filter="web">Web Applications</button>
        <button class="filter-btn" data-filter="ai">AI &amp; Machine Learning</button>
        <button class="filter-btn" data-filter="software">Software Systems</button>
        <button class="filter-btn" data-filter="ui">UI/UX Design</button>
      </div>

      <!-- Projects Grid (Loaded Dynamically from JSON) -->
      <div class="projects-grid">
        <?php foreach (array_slice($projects, 0, 6) as $proj): ?>
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
                <?php if (!empty($proj['demo_url'])): ?>
                  <a href="<?php echo htmlspecialchars($proj['demo_url']); ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8125rem;">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>View Demo</span>
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

      <div style="text-align: center; margin-top: 3.5rem;">
        <a href="projects.php" class="btn btn-secondary" style="border-color: var(--accent-purple);">
          <span>View All <?php echo count($projects); ?> Projects</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       5. GRAPHICS DESIGN PORTFOLIO & CATEGORY FILTER
       ========================================================================= -->
  <section id="graphics" class="section-spacing" style="background: var(--bg-surface-elevated);">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag">Visual Arts</span>
        <h2 class="section-title">Graphics &amp; Brand Design Portfolio</h2>
        <p class="section-subtitle">A curated collection of corporate branding, event flyers, social media campaigns, typography, and visual identities.</p>
      </div>

      <!-- Graphics Category Filter Tabs -->
      <div class="graphics-filter-controls" data-target=".graphic-item-card" style="display: flex; justify-content: center; flex-wrap: wrap; gap: 0.55rem; margin-bottom: 2.5rem;">
        <button class="filter-btn active" data-filter="all">All Artwork</button>
        <button class="filter-btn" data-filter="flyers">Flyers &amp; Print</button>
        <button class="filter-btn" data-filter="branding">Branding &amp; Identity</button>
        <button class="filter-btn" data-filter="social">Social Media</button>
        <button class="filter-btn" data-filter="posters">Posters &amp; Art</button>
        <button class="filter-btn" data-filter="logos">Logos</button>
      </div>

      <!-- Graphics Masonry Grid -->
      <div class="graphics-masonry-grid">
        <?php foreach (array_slice($graphics, 0, 6) as $gfx): ?>
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

      <div style="text-align: center; margin-top: 3.5rem;">
        <a href="graphics.php" class="btn btn-secondary" style="border-color: var(--accent-cyan);">
          <span>View Full Graphics Portfolio</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- Lightbox Modal -->
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

  <!-- =========================================================================
       6. AI & DEEP TECH SECTION (INTERACTIVE SIMULATOR)
       ========================================================================= -->
  <section id="ai" class="section-spacing ai-tech-section">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag amber">Artificial Intelligence</span>
        <h2 class="section-title">Deep Learning &amp; Intelligent Systems</h2>
        <p class="section-subtitle">Bridging theoretical neural network concepts into practical conversational agents, BERT language models, and predictive algorithms.</p>
      </div>

      <!-- Interactive AI Sandbox Widget -->
      <div class="ai-interactive-card reveal-on-scroll">
        <div class="ai-card-header">
          <div class="ai-model-status">
            <i class="fa-solid fa-terminal" style="color: var(--accent-purple);"></i>
            <span>GBEST Neural Inference Terminal v2.4</span>
          </div>
          <div style="display: flex; gap: 1.5rem; font-size: 0.8125rem; font-family: var(--font-mono); color: var(--text-muted);">
            <span>Latency: <strong id="aiLatencyBadge" style="color: var(--accent-cyan);">28ms</strong></span>
            <span>Confidence: <strong id="aiConfidenceBadge" style="color: var(--accent-emerald);">99.4%</strong></span>
          </div>
        </div>

        <div style="margin-bottom: 1.25rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
          <button class="filter-btn ai-demo-preset active" data-mode="bert">BERT Department Assistant</button>
          <button class="filter-btn ai-demo-preset" data-mode="predict">Student GPA Predictor</button>
          <button class="filter-btn ai-demo-preset" data-mode="detector">AI Text Classifier</button>
          <button class="filter-btn ai-demo-preset" data-mode="diabetes">Diabetes Medical Bot</button>
        </div>

        <div style="display: flex; gap: 0.75rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
          <input type="text" id="aiDemoInput" class="form-input" style="font-family: var(--font-mono); font-size: 0.875rem; flex: 1 1 240px; min-width: 0;" value="What are the course prerequisites for CSC 401?" placeholder="Enter prompt to run inference...">
          <button id="aiDemoRunBtn" class="btn btn-primary" style="flex-shrink: 0; min-height: 42px;">
            <i class="fa-solid fa-play"></i>
            <span>Run Inference</span>
          </button>
        </div>

        <div id="aiTerminalOutput" class="ai-terminal-window">
          <pre style="white-space: pre-wrap; font-family: var(--font-mono); color: #A7F3D0;">[BERT-NLP-MODEL] Analyzing query semantics...
> Embeddings projected: 768-dim tensor
> Intent Classification: Departmental Course Registration &amp; Prerequisite Query
> Matched Entity: CSC 401 (Artificial Intelligence &amp; Neural Nets)
> System Response: "CSC 401 requires completion of CSC 301 and MTH 201 with minimum grade C. Registration closes on Friday 4:00 PM."
> Confidence Score: 0.994 | Status: RESOLVED</pre>
        </div>
      </div>

      <div style="text-align: center; margin-top: 3rem;">
        <a href="ai.php" class="btn btn-outline-cyan">
          <span>Explore AI Architectures &amp; Research</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       7. TESTIMONIALS SECTION
       ========================================================================= -->
  <section id="testimonials" class="section-spacing">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag amber">Testimonials</span>
        <h2 class="section-title">What Clients &amp; Collaborators Say</h2>
        <p class="section-subtitle">Real feedback from departmental partners, academic advisors, and client project stakeholders.</p>
      </div>

      <div class="testimonials-slider-wrap reveal-on-scroll">
        <div id="testimonialTrack" class="testimonials-track">
          <div class="testimonial-slide">
            <div class="testimonial-card">
              <i class="fa-solid fa-quote-right testimonial-quote-icon"></i>
              <div class="testimonial-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
              </div>
              <p class="testimonial-text">
                "Gbolahan's ability to blend high-end visual design with deep backend code is truly exceptional. The SIWES Allocation portal he developed streamlined what used to take weeks into minutes. Outstanding engineering!"
              </p>
              <div class="testimonial-author-box">
                <img src="assets/images/avatars/avatar-1.svg" alt="Dr. Samuel Adeyemi" class="author-avatar">
                <div>
                  <div class="author-name">Dr. Samuel Adeyemi</div>
                  <div class="author-role">Academic Coordinator &amp; Department Supervisor</div>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-slide">
            <div class="testimonial-card">
              <i class="fa-solid fa-quote-right testimonial-quote-icon"></i>
              <div class="testimonial-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
              </div>
              <p class="testimonial-text">
                "Working with Gbolahan on our healthcare digital platform was seamless. His mastery of database design, secure APIs, and intuitive UI created a product our clinical team loves using."
              </p>
              <div class="testimonial-author-box">
                <img src="assets/images/avatars/avatar-2.svg" alt="Amina Bello" class="author-avatar">
                <div>
                  <div class="author-name">Amina Bello</div>
                  <div class="author-role">Product Lead, HealthCare Tech Initiatives</div>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-slide">
            <div class="testimonial-card">
              <i class="fa-solid fa-quote-right testimonial-quote-icon"></i>
              <div class="testimonial-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
              </div>
              <p class="testimonial-text">
                "GBEST designed our complete corporate branding and event collateral for the 2026 Tech Summit. Every flyer, logo, and digital asset was delivered with prompt turnaround and world-class polish."
              </p>
              <div class="testimonial-author-box">
                <img src="assets/images/avatars/avatar-3.svg" alt="Tunde Ogunleye" class="author-avatar">
                <div>
                  <div class="author-name">Tunde Ogunleye</div>
                  <div class="author-role">Founder &amp; Creative Director, Studio Pulse</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="slider-controls">
          <button id="testimonialPrevBtn" class="btn btn-secondary btn-icon" aria-label="Previous Testimonial"><i class="fa-solid fa-chevron-left"></i></button>
          <div id="testimonialDots" class="slider-dots"></div>
          <button id="testimonialNextBtn" class="btn btn-secondary btn-icon" aria-label="Next Testimonial"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       8. CONTACT SECTION
       ========================================================================= -->
  <section id="contact" class="section-spacing contact-section">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag cyan">Get In Touch</span>
        <h2 class="section-title">Let's Build Something Great Together</h2>
        <p class="section-subtitle">Have a project, idea, or technology collaboration in mind? Let's turn your vision into high-impact reality.</p>
      </div>

      <div class="contact-layout-grid">
        <!-- Left: Contact Details -->
        <div class="contact-info-card reveal-on-scroll">
          <h3 style="font-size: 1.5rem; margin-bottom: 0.75rem;">Contact Information</h3>
          <p style="font-size: 0.9375rem; margin-bottom: 2rem;">Feel free to reach out directly via email, phone, or any of my social profiles. I typically respond within 24 hours.</p>

          <div class="contact-direct-list">
            <div class="contact-direct-item">
              <div class="direct-icon-wrap"><i class="fa-solid fa-envelope"></i></div>
              <div>
                <div class="direct-label">Email Address</div>
                <a href="mailto:<?php echo htmlspecialchars($siteConfig['contact']['email']); ?>" class="direct-value"><?php echo htmlspecialchars($siteConfig['contact']['email']); ?></a>
              </div>
            </div>

            <div class="contact-direct-item">
              <div class="direct-icon-wrap" style="color: var(--accent-cyan);"><i class="fa-solid fa-phone"></i></div>
              <div>
                <div class="direct-label">Phone / WhatsApp</div>
                <a href="<?php echo htmlspecialchars($siteConfig['contact']['whatsapp_url']); ?>" target="_blank" class="direct-value"><?php echo htmlspecialchars($siteConfig['contact']['phone_display']); ?></a>
              </div>
            </div>

            <div class="contact-direct-item">
              <div class="direct-icon-wrap" style="color: var(--accent-amber);"><i class="fa-solid fa-location-dot"></i></div>
              <div>
                <div class="direct-label">Location</div>
                <div class="direct-value"><?php echo htmlspecialchars($siteConfig['contact']['location']); ?></div>
              </div>
            </div>
          </div>

          <div style="border-top: 1px solid var(--border-light); padding-top: 1.5rem; margin-top: 1.5rem;">
            <span style="display: block; font-size: 0.8125rem; color: var(--text-muted); margin-bottom: 1rem;">Follow &amp; Connect:</span>
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['github']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['twitter']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['contact']['whatsapp_url']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
          </div>
        </div>

        <!-- Right: Asynchronous Contact Form -->
        <div class="contact-form-card reveal-on-scroll reveal-delay-1">
          <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem;">Send a Direct Message</h3>

          <form id="contactForm" method="POST" action="contact.php">
            <div class="form-group">
              <label for="contactName" class="form-label">Your Full Name <span style="color: #EF4444;">*</span></label>
              <input type="text" id="contactName" name="name" class="form-input" placeholder="e.g. Samuel Adeyemi" required autocomplete="name">
            </div>

            <div class="form-group">
              <label for="contactEmail" class="form-label">Your Email Address <span style="color: #EF4444;">*</span></label>
              <input type="email" id="contactEmail" name="email" class="form-input" placeholder="e.g. samuel@example.com" required autocomplete="email">
            </div>

            <div class="form-group">
              <label for="contactSubject" class="form-label">Subject / Service Needed <span style="color: #EF4444;">*</span></label>
              <input type="text" id="contactSubject" name="subject" class="form-input" placeholder="e.g. New Web Application / Brand Design Inquiry" required>
            </div>

            <div class="form-group">
              <label for="contactMessage" class="form-label">Your Message <span style="color: #EF4444;">*</span></label>
              <textarea id="contactMessage" name="message" class="form-textarea" placeholder="Tell me about your project, timeline, and goals..." required></textarea>
            </div>

            <button type="submit" id="contactSubmitBtn" class="btn btn-primary" style="width: 100%; padding: 0.95rem;">
              <i class="fa-solid fa-paper-plane"></i>
              <span>Send Message</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

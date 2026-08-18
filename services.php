<?php
/**
 * GBEST / GBTech - Services Dedicated Page
 * Author: Gbolahan Alade
 */

$currentPage = 'services';
$pageTitle = 'Services & Solutions | Gbolahan Alade — GBEST';

require_once __DIR__ . '/includes/header.php';

$pagesContent = get_pages_content();
$pageData = $pagesContent['services'] ?? [];
?>

<main>
  <!-- Page Header with Dynamic Hero Background Image -->
  <section class="page-hero-banner" style="background-image: url('<?php echo htmlspecialchars($pageData['hero_bg_image'] ?? 'assets/images/hero-bgs/services-hero.svg'); ?>');">
    <div class="container" style="text-align: center;">
      <span class="badge-tag amber"><?php echo htmlspecialchars($pageData['badge'] ?? 'What I Offer'); ?></span>
      <h1 class="section-title" style="font-size: clamp(2rem, 5vw, 3rem); margin-top: 0.5rem;">
        <span class="animated-gradient-text"><?php echo htmlspecialchars($pageData['title'] ?? 'Services & Solutions'); ?></span>
      </h1>
      <p class="section-subtitle" style="max-width: 680px; margin: 0 auto;">
        <?php echo htmlspecialchars($pageData['subtitle'] ?? 'End-to-end creative and engineering services tailored for businesses, startups, and academic institutions.'); ?>
      </p>
    </div>
  </section>

  <!-- Services Grid -->
  <section class="section-spacing" style="padding-top: 1rem;">
    <div class="container">
      <div class="services-grid">
        <!-- Service 1 -->
        <div class="service-card reveal-on-scroll">
          <div class="service-icon-box"><i class="fa-solid fa-pen-ruler fa-xl"></i></div>
          <h3 class="service-title">Graphic Design &amp; Brand Identity</h3>
          <p class="service-desc">Complete corporate brand systems, high-converting event flyers, marketing posters, social media campaign kits, and vector logo design.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> Logo Design &amp; Visual Guidelines</li>
            <li><i class="fa-solid fa-circle-check"></i> Event Flyers &amp; Conference Posters</li>
            <li><i class="fa-solid fa-circle-check"></i> Social Media Marketing Ad Kits</li>
            <li><i class="fa-solid fa-circle-check"></i> Print Stationery &amp; Packaging Layouts</li>
          </ul>
          <div style="margin-top: 1.5rem;">
            <a href="graphics.php" class="btn btn-outline-cyan btn-sm"><span>View Graphics Portfolio</span> <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Service 2 -->
        <div class="service-card reveal-on-scroll reveal-delay-1">
          <div class="service-icon-box" style="color: var(--accent-cyan); background: rgba(6, 182, 212, 0.1);"><i class="fa-solid fa-laptop-code fa-xl"></i></div>
          <h3 class="service-title">Full-Stack Web Development</h3>
          <p class="service-desc">Custom web applications engineered with semantic HTML5, CSS3, modern JavaScript, PHP 8+, and PostgreSQL databases. Fast, secure, and mobile-first.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> Custom Web Application Development</li>
            <li><i class="fa-solid fa-circle-check"></i> Responsive Mobile-First Architecture</li>
            <li><i class="fa-solid fa-circle-check"></i> Database Design &amp; SQL Query Tuning</li>
            <li><i class="fa-solid fa-circle-check"></i> REST API Development &amp; Integrations</li>
          </ul>
          <div style="margin-top: 1.5rem;">
            <a href="webdev.php" class="btn btn-outline-cyan btn-sm"><span>View Web Projects</span> <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Service 3 -->
        <div class="service-card reveal-on-scroll reveal-delay-2">
          <div class="service-icon-box" style="color: #EC4899; background: rgba(236, 72, 153, 0.1);"><i class="fa-solid fa-cubes fa-xl"></i></div>
          <h3 class="service-title">UI/UX Interface Design</h3>
          <p class="service-desc">User-centric interactive wireframes, prototypes, and design systems crafted in Figma to turn complicated product requirements into intuitive digital workflows.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> Figma High-Fidelity UI Mockups</li>
            <li><i class="fa-solid fa-circle-check"></i> Clickable Interactive Prototypes</li>
            <li><i class="fa-solid fa-circle-check"></i> Component Libraries &amp; Design Systems</li>
            <li><i class="fa-solid fa-circle-check"></i> Usability Testing &amp; Accessibility (a11y)</li>
          </ul>
          <div style="margin-top: 1.5rem;">
            <a href="projects.php" class="btn btn-outline-cyan btn-sm"><span>Explore UI Work</span> <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Service 4 -->
        <div class="service-card reveal-on-scroll">
          <div class="service-icon-box" style="color: var(--accent-amber); background: rgba(245, 158, 11, 0.1);"><i class="fa-solid fa-brain fa-xl"></i></div>
          <h3 class="service-title">AI &amp; Intelligent Solutions</h3>
          <p class="service-desc">Custom AI-powered conversational chatbots, student performance prediction engines, BERT NLP knowledge assistants, and text forensics classifiers.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> Conversational NLP Chatbots</li>
            <li><i class="fa-solid fa-circle-check"></i> Predictive Machine Learning Models</li>
            <li><i class="fa-solid fa-circle-check"></i> BERT Transformer Implementation</li>
            <li><i class="fa-solid fa-circle-check"></i> Synthetic Text Detection &amp; Classification</li>
          </ul>
          <div style="margin-top: 1.5rem;">
            <a href="ai.php" class="btn btn-outline-cyan btn-sm"><span>Test AI Sandbox</span> <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Service 5 -->
        <div class="service-card reveal-on-scroll reveal-delay-1">
          <div class="service-icon-box" style="color: var(--accent-emerald); background: rgba(16, 185, 129, 0.1);"><i class="fa-solid fa-gears fa-xl"></i></div>
          <h3 class="service-title">Custom Software Engineering</h3>
          <p class="service-desc">Tailored institutional platforms such as student SIWES allocation portals, hospital electronic medical records (EMR), and biometric attendance monitors.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> SIWES Placement &amp; Grading Systems</li>
            <li><i class="fa-solid fa-circle-check"></i> Healthcare Diagnostic EMR Platforms</li>
            <li><i class="fa-solid fa-circle-check"></i> Contactless FaceNet Biometric Logging</li>
            <li><i class="fa-solid fa-circle-check"></i> Secure Role-Based Access Control (RBAC)</li>
          </ul>
          <div style="margin-top: 1.5rem;">
            <a href="projects.php" class="btn btn-outline-cyan btn-sm"><span>View Software Portfolio</span> <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Service 6 -->
        <div class="service-card reveal-on-scroll reveal-delay-2">
          <div class="service-icon-box" style="color: #38BDF8; background: rgba(56, 189, 248, 0.1);"><i class="fa-solid fa-rocket fa-xl"></i></div>
          <h3 class="service-title">Digital Strategy &amp; Deployment</h3>
          <p class="service-desc">Helping traditional businesses, agencies, and academic wings transition legacy processes into automated cloud-hosted digital infrastructure.</p>
          <ul class="service-features-list">
            <li><i class="fa-solid fa-circle-check"></i> Server Configuration (Nginx / Linux)</li>
            <li><i class="fa-solid fa-circle-check"></i> Docker Containerization &amp; Deployment</li>
            <li><i class="fa-solid fa-circle-check"></i> Search Engine Optimization &amp; Speed Audits</li>
            <li><i class="fa-solid fa-circle-check"></i> Continuous Tech Advisory &amp; Maintenance</li>
          </ul>
          <div style="margin-top: 1.5rem;">
            <a href="contact.php" class="btn btn-primary btn-sm"><span>Inquire About Consulting</span> <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Project Delivery Process Section -->
  <section class="section-spacing" style="background: var(--bg-surface-elevated);">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag">Process</span>
        <h2 class="section-title">How We Work Together</h2>
        <p class="section-subtitle">A transparent, milestone-driven framework from initial concept discovery to deployment and support.</p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
        <div class="stat-card reveal-on-scroll" style="text-align: left; padding: 2rem 1.5rem;">
          <div style="font-family: var(--font-mono); color: var(--accent-cyan); font-weight: 700; font-size: 0.875rem; margin-bottom: 0.5rem;">STEP 01</div>
          <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Discovery &amp; Strategy</h3>
          <p style="font-size: 0.875rem; color: var(--text-muted);">Defining goals, target audience, technical scope, and project deliverables.</p>
        </div>

        <div class="stat-card reveal-on-scroll reveal-delay-1" style="text-align: left; padding: 2rem 1.5rem;">
          <div style="font-family: var(--font-mono); color: var(--accent-purple); font-weight: 700; font-size: 0.875rem; margin-bottom: 0.5rem;">STEP 02</div>
          <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Design &amp; Prototyping</h3>
          <p style="font-size: 0.875rem; color: var(--text-muted);">Crafting visual identities, UI mockups, and database architecture schemas.</p>
        </div>

        <div class="stat-card reveal-on-scroll reveal-delay-2" style="text-align: left; padding: 2rem 1.5rem;">
          <div style="font-family: var(--font-mono); color: var(--accent-amber); font-weight: 700; font-size: 0.875rem; margin-bottom: 0.5rem;">STEP 03</div>
          <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Development &amp; AI</h3>
          <p style="font-size: 0.875rem; color: var(--text-muted);">Writing clean, maintainable code, setting up databases, and training models.</p>
        </div>

        <div class="stat-card reveal-on-scroll reveal-delay-3" style="text-align: left; padding: 2rem 1.5rem;">
          <div style="font-family: var(--font-mono); color: var(--accent-emerald); font-weight: 700; font-size: 0.875rem; margin-bottom: 0.5rem;">STEP 04</div>
          <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Testing &amp; Deployment</h3>
          <p style="font-size: 0.875rem; color: var(--text-muted);">Rigorous QA, responsive verification, cloud deployment, and handover.</p>
        </div>
      </div>

      <div style="text-align: center; margin-top: 3.5rem;">
        <a href="contact.php" class="btn btn-primary">
          <span>Start Your Project Today</span>
          <i class="fa-solid fa-paper-plane"></i>
        </a>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<?php
/**
 * GBEST / GBTech - Skills & Technologies Dedicated Page
 * Author: Gbolahan Alade
 */

$currentPage = 'skills';
$pageTitle = 'Skills & Technologies | Gbolahan Alade — GBEST';

require_once __DIR__ . '/includes/header.php';

$pagesContent = get_pages_content();
$pageData = $pagesContent['skills'] ?? [];
?>

<main>
  <!-- Page Header with Dynamic Hero Background Image -->
  <section class="page-hero-banner" style="background-image: url('<?php echo htmlspecialchars($pageData['hero_bg_image'] ?? 'assets/images/hero-bgs/skills-hero.svg'); ?>');">
    <div class="container" style="text-align: center;">
      <span class="badge-tag cyan"><?php echo htmlspecialchars($pageData['badge'] ?? 'Technical Arsenal'); ?></span>
      <h1 class="section-title" style="font-size: clamp(2rem, 5vw, 3rem); margin-top: 0.5rem;">
        <span class="animated-gradient-text"><?php echo htmlspecialchars($pageData['title'] ?? 'Skills & Technologies'); ?></span>
      </h1>
      <p class="section-subtitle" style="max-width: 680px; margin: 0 auto;">
        <?php echo htmlspecialchars($pageData['subtitle'] ?? 'A multi-disciplinary stack across graphic design suites, full-stack programming, cloud infrastructure, and AI engineering.'); ?>
      </p>
    </div>
  </section>

  <!-- Skills Tabs & Matrix -->
  <section class="section-spacing" style="padding-top: 1rem;">
    <div class="container">
      <div class="skills-container-box reveal-on-scroll">
        <!-- Category Tabs -->
        <div class="skills-category-tabs">
          <button class="skill-tab-btn active" data-tab="tab-design">
            <i class="fa-solid fa-palette"></i>
            <span>Design &amp; Creative</span>
          </button>
          <button class="skill-tab-btn" data-tab="tab-web">
            <i class="fa-solid fa-code"></i>
            <span>Web Development</span>
          </button>
          <button class="skill-tab-btn" data-tab="tab-devops">
            <i class="fa-solid fa-server"></i>
            <span>Dev &amp; Deployment</span>
          </button>
          <button class="skill-tab-btn" data-tab="tab-ai">
            <i class="fa-solid fa-brain"></i>
            <span>AI &amp; Emerging Tech</span>
          </button>
        </div>

        <!-- Tab 1: Design -->
        <div id="tab-design" class="skills-tab-pane active">
          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-image"></i></div>
                <span class="skill-name">Adobe Photoshop</span>
              </div>
              <span class="skill-level-pct">95%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 95%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-pen-nib"></i></div>
                <span class="skill-name">CorelDRAW</span>
              </div>
              <span class="skill-level-pct">92%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 92%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-brands fa-figma"></i></div>
                <span class="skill-name">Figma UI/UX</span>
              </div>
              <span class="skill-level-pct">90%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 90%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                <span class="skill-name">Canva Pro</span>
              </div>
              <span class="skill-level-pct">96%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 96%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-layer-group"></i></div>
                <span class="skill-name">Brand Identity &amp; Typography</span>
              </div>
              <span class="skill-level-pct">94%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 94%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-print"></i></div>
                <span class="skill-name">Print &amp; Editorial Layouts</span>
              </div>
              <span class="skill-level-pct">90%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 90%;"></div></div>
          </div>
        </div>

        <!-- Tab 2: Web Dev -->
        <div id="tab-web" class="skills-tab-pane">
          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-brands fa-html5"></i></div>
                <span class="skill-name">HTML5 &amp; Semantic Standards</span>
              </div>
              <span class="skill-level-pct">98%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 98%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-brands fa-css3-alt"></i></div>
                <span class="skill-name">CSS3 &amp; Glassmorphic Layouts</span>
              </div>
              <span class="skill-level-pct">95%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 95%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-info">
                  <div class="skill-icon-wrap"><i class="fa-brands fa-js"></i></div>
                  <span class="skill-name">JavaScript (ES6+)</span>
                </div>
              </div>
              <span class="skill-level-pct">90%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 90%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-brands fa-bootstrap"></i></div>
                <span class="skill-name">Bootstrap 5 &amp; Responsive UI</span>
              </div>
              <span class="skill-level-pct">94%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 94%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-brands fa-php"></i></div>
                <span class="skill-name">PHP 8+ Backend &amp; OOP</span>
              </div>
              <span class="skill-level-pct">88%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 88%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-database"></i></div>
                <span class="skill-name">PostgreSQL &amp; Relational SQL</span>
              </div>
              <span class="skill-level-pct">86%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 86%;"></div></div>
          </div>
        </div>

        <!-- Tab 3: Dev & Deployment -->
        <div id="tab-devops" class="skills-tab-pane">
          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-brands fa-git-alt"></i></div>
                <span class="skill-name">Git &amp; Version Control</span>
              </div>
              <span class="skill-level-pct">92%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 92%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-brands fa-github"></i></div>
                <span class="skill-name">GitHub Actions &amp; Collaboration</span>
              </div>
              <span class="skill-level-pct">89%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 89%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-brands fa-docker"></i></div>
                <span class="skill-name">Docker &amp; Containerization</span>
              </div>
              <span class="skill-level-pct">82%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 82%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                <span class="skill-name">Render &amp; Cloud Deployment</span>
              </div>
              <span class="skill-level-pct">88%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 88%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-server"></i></div>
                <span class="skill-name">Nginx &amp; Server Config</span>
              </div>
              <span class="skill-level-pct">85%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 85%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-network-wired"></i></div>
                <span class="skill-name">RESTful APIs &amp; JSON Endpoints</span>
              </div>
              <span class="skill-level-pct">92%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 92%;"></div></div>
          </div>
        </div>

        <!-- Tab 4: AI & Emerging Tech -->
        <div id="tab-ai" class="skills-tab-pane">
          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-robot"></i></div>
                <span class="skill-name">Conversational NLP Chatbots</span>
              </div>
              <span class="skill-level-pct">94%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 94%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-diagram-project"></i></div>
                <span class="skill-name">Machine Learning Regression/Classifiers</span>
              </div>
              <span class="skill-level-pct">88%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 88%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-comments"></i></div>
                <span class="skill-name">BERT Transformers &amp; Attention Models</span>
              </div>
              <span class="skill-level-pct">91%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 91%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-eye"></i></div>
                <span class="skill-name">Computer Vision &amp; FaceNet</span>
              </div>
              <span class="skill-level-pct">84%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 84%;"></div></div>
          </div>

          <div class="skill-card">
            <div class="skill-card-top">
              <div class="skill-info">
                <div class="skill-icon-wrap"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                <span class="skill-name">Prompt Engineering &amp; LLM Integrations</span>
              </div>
              <span class="skill-level-pct">93%</span>
            </div>
            <div class="skill-bar-track"><div class="skill-bar-fill" style="width: 93%;"></div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Marquee Banner -->
  <div class="marquee-wrapper">
    <div class="marquee-track">
      <span class="tech-marquee-badge"><i class="fa-brands fa-html5"></i> HTML5</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-css3-alt"></i> CSS3</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-js"></i> JavaScript</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-bootstrap"></i> Bootstrap 5</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-php"></i> PHP 8+</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-database"></i> PostgreSQL</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-python"></i> Python</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-git-alt"></i> Git</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-github"></i> GitHub</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-docker"></i> Docker</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-server"></i> Nginx</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-figma"></i> Figma</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-wand-magic-sparkles"></i> Canva</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-image"></i> Photoshop</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-pen-nib"></i> CorelDRAW</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-brain"></i> AI &amp; BERT</span>
      <!-- Repeated for continuous marquee -->
      <span class="tech-marquee-badge"><i class="fa-brands fa-html5"></i> HTML5</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-css3-alt"></i> CSS3</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-js"></i> JavaScript</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-bootstrap"></i> Bootstrap 5</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-php"></i> PHP 8+</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-database"></i> PostgreSQL</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-python"></i> Python</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-git-alt"></i> Git</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-github"></i> GitHub</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-docker"></i> Docker</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-server"></i> Nginx</span>
      <span class="tech-marquee-badge"><i class="fa-brands fa-figma"></i> Figma</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-wand-magic-sparkles"></i> Canva</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-image"></i> Photoshop</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-pen-nib"></i> CorelDRAW</span>
      <span class="tech-marquee-badge"><i class="fa-solid fa-brain"></i> AI &amp; BERT</span>
    </div>
  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

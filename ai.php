<?php
/**
 * GBEST / GBTech - AI & Deep Tech Dedicated Page
 * Author: Gbolahan Alade
 */

$currentPage = 'ai';
$pageTitle = 'Artificial Intelligence & Deep Tech | Gbolahan Alade — GBEST';

require_once __DIR__ . '/includes/header.php';

$aiProjects = get_projects('ai');
$pagesContent = get_pages_content();
$pageData = $pagesContent['ai'] ?? [];
?>

<main>
  <!-- Page Header with Dynamic Hero Background Image -->
  <section class="page-hero-banner" style="background-image: url('<?php echo htmlspecialchars($pageData['hero_bg_image'] ?? 'assets/images/hero-bgs/ai-hero.svg'); ?>');">
    <div class="container" style="text-align: center;">
      <span class="badge-tag amber"><?php echo htmlspecialchars($pageData['badge'] ?? 'Artificial Intelligence'); ?></span>
      <h1 class="section-title" style="font-size: clamp(2rem, 5vw, 3rem); margin-top: 0.5rem;">
        <span class="animated-gradient-text"><?php echo htmlspecialchars($pageData['title'] ?? 'Deep Learning & Applied AI Systems'); ?></span>
      </h1>
      <p class="section-subtitle" style="max-width: 680px; margin: 0 auto;">
        <?php echo htmlspecialchars($pageData['subtitle'] ?? 'Bridging transformer architectures, predictive continuous assessment algorithms, biometric vision, and clinical NLP into usable applications.'); ?>
      </p>
    </div>
  </section>

  <!-- Interactive AI Inference Sandbox -->
  <section class="section-spacing ai-tech-section" style="padding-top: 1rem;">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag cyan">Live Sandbox</span>
        <h2 class="section-title" style="font-size: 2.25rem;">Interactive Neural Inference Terminal</h2>
        <p class="section-subtitle">Select a pre-trained model task below to simulate real-time token embeddings, attention classification, and regression inference.</p>
      </div>

      <div class="ai-interactive-card reveal-on-scroll" style="margin-top: 1rem;">
        <div class="ai-card-header">
          <div class="ai-model-status">
            <i class="fa-solid fa-terminal" style="color: var(--accent-purple);"></i>
            <span>GBEST Neural Inference Terminal v2.4 (PyTorch / Transformer Backend)</span>
          </div>
          <div style="display: flex; gap: 1.5rem; font-size: 0.8125rem; font-family: var(--font-mono); color: var(--text-muted);">
            <span>Latency: <strong id="aiLatencyBadge" style="color: var(--accent-cyan);">28ms</strong></span>
            <span>Confidence: <strong id="aiConfidenceBadge" style="color: var(--accent-emerald);">99.4%</strong></span>
          </div>
        </div>

        <!-- Preset Switcher -->
        <div style="margin-bottom: 1.25rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
          <button class="filter-btn ai-demo-preset active" data-mode="bert">BERT Department Assistant</button>
          <button class="filter-btn ai-demo-preset" data-mode="predict">Student GPA Predictor</button>
          <button class="filter-btn ai-demo-preset" data-mode="detector">AI Text Classifier</button>
          <button class="filter-btn ai-demo-preset" data-mode="diabetes">Diabetes Medical Bot</button>
        </div>

        <!-- Input row -->
        <div style="display: flex; gap: 0.75rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
          <input type="text" id="aiDemoInput" class="form-input" style="font-family: var(--font-mono); font-size: 0.875rem; flex: 1 1 240px; min-width: 0;" value="What are the course prerequisites for CSC 401?" placeholder="Enter prompt to run inference...">
          <button id="aiDemoRunBtn" class="btn btn-primary" style="flex-shrink: 0; min-height: 42px;">
            <i class="fa-solid fa-play"></i>
            <span>Run Inference</span>
          </button>
        </div>

        <!-- Terminal Output View -->
        <div id="aiTerminalOutput" class="ai-terminal-window">
          <pre style="white-space: pre-wrap; font-family: var(--font-mono); color: #A7F3D0;">[BERT-NLP-MODEL] Analyzing query semantics...
> Embeddings projected: 768-dim tensor
> Intent Classification: Departmental Course Registration &amp; Prerequisite Query
> Matched Entity: CSC 401 (Artificial Intelligence &amp; Neural Nets)
> System Response: "CSC 401 requires completion of CSC 301 and MTH 201 with minimum grade C. Registration closes on Friday 4:00 PM."
> Confidence Score: 0.994 | Status: RESOLVED</pre>
        </div>
      </div>
    </div>
  </section>

  <!-- AI Projects Grid -->
  <section class="section-spacing">
    <div class="container">
      <div class="section-header reveal-on-scroll">
        <span class="badge-tag">AI Portfolio</span>
        <h2 class="section-title">Applied AI &amp; Machine Learning Projects</h2>
        <p class="section-subtitle">Realized implementations demonstrating Natural Language Processing, computer vision, and predictive statistics.</p>
      </div>

      <div class="projects-grid">
        <?php foreach ($aiProjects as $proj): ?>
          <article class="project-card project-item reveal-on-scroll" data-category="ai">
            <div class="project-image-wrap">
              <img src="<?php echo htmlspecialchars($proj['image']); ?>" alt="<?php echo htmlspecialchars($proj['title']); ?>" class="project-img" loading="lazy">
              <span class="project-category-badge"><?php echo htmlspecialchars($proj['category_label'] ?? 'AI Solution'); ?></span>
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
                <a href="#ai" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8125rem;">
                  <i class="fa-solid fa-microchip"></i>
                  <span>Test Model</span>
                </a>
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
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

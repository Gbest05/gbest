<?php
/**
 * GBEST / GBTech - Reusable Modern Responsive Header
 * Author: Gbolahan Alade
 */

if (!defined('GBEST_ROOT')) {
    define('GBEST_ROOT', dirname(__DIR__));
}
require_once GBEST_ROOT . '/includes/config.php';

$siteConfig = get_site_config();
$currentPage = $currentPage ?? 'home';
$pageTitle = $pageTitle ?? ($siteConfig['owner_name'] . ' | ' . $siteConfig['professional_title']);
$pageDescription = $pageDescription ?? ($siteConfig['tagline'] . ' ' . $siteConfig['hero_description']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Primary SEO Metadata -->
  <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
  <meta name="title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="keywords" content="Gbolahan Alade, GBEST, GBTech, Graphics Designer, Web Developer, AI Enthusiast, Machine Learning, Full Stack Developer, Nigeria Developer, BERT NLP, UI UX Design">
  <meta name="author" content="<?php echo htmlspecialchars($siteConfig['owner_name'], ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="robots" content="index, follow">

  <!-- Open Graph / Social -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars($siteConfig['profile_image'], ENT_QUOTES, 'UTF-8'); ?>">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="<?php echo htmlspecialchars($siteConfig['logo_image'], ENT_QUOTES, 'UTF-8'); ?>?v=<?php echo time(); ?>">

  <!-- Google Fonts: Space Grotesk, Syne, Plus Jakarta Sans, JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@600;700;800&family=Syne:wght@600;700;800;900&display=swap" rel="stylesheet">

  <!-- Font Awesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Main Stylesheets -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="assets/css/animations.css?v=<?php echo time(); ?>">

  <!-- Global Theme Toggle Engine -->
  <script src="assets/js/theme.js"></script>
</head>
<body>

  <!-- Top Scroll Progress Bar -->
  <div id="scrollProgressBar" class="scroll-progress-bar" aria-hidden="true"></div>

  <!-- Mobile Navigation Drawer Backdrop Overlay -->
  <div id="navDrawerBackdrop" class="nav-drawer-backdrop" aria-hidden="true"></div>

  <!-- Ambient Glow Spheres in background -->
  <div class="glow-orb glow-purple" style="top: 8%; left: -100px; width: 450px; height: 450px;"></div>
  <div class="glow-orb glow-cyan" style="top: 35%; right: -120px; width: 500px; height: 500px;"></div>
  <div class="glow-orb glow-amber" style="top: 70%; left: -80px; width: 400px; height: 400px;"></div>

  <!-- =========================================================================
       RE-DESIGNED MODERN RESPONSIVE HEADER
       ========================================================================= -->
  <header>
    <nav id="navbar" class="navbar">
      <div class="container nav-container">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-logo" aria-label="<?php echo htmlspecialchars($siteConfig['brand_name']); ?> Portfolio Home">
          <div class="brand-icon-box"><?php echo htmlspecialchars($siteConfig['brand_badge']); ?></div>
          <div class="brand-text-wrap">
            <span class="brand-name"><?php echo htmlspecialchars($siteConfig['brand_name']); ?><span>.</span></span>
            <span class="brand-tagline"><?php echo htmlspecialchars($siteConfig['brand_tagline']); ?></span>
          </div>
        </a>

        <!-- Desktop Navigation Bar Links (Dedicated Pages) -->
        <ul id="navMenu" class="nav-menu">
          <li><a href="index.php" class="nav-link <?php echo $currentPage === 'home' ? 'active' : ''; ?>">Home</a></li>
          <li><a href="about.php" class="nav-link <?php echo $currentPage === 'about' ? 'active' : ''; ?>">About</a></li>
          <li><a href="skills.php" class="nav-link <?php echo $currentPage === 'skills' ? 'active' : ''; ?>">Skills</a></li>
          <li><a href="services.php" class="nav-link <?php echo $currentPage === 'services' ? 'active' : ''; ?>">Services</a></li>
          <li><a href="projects.php" class="nav-link <?php echo $currentPage === 'projects' ? 'active' : ''; ?>">Projects</a></li>
          <li><a href="graphics.php" class="nav-link <?php echo $currentPage === 'graphics' ? 'active' : ''; ?>">Graphics</a></li>
          <li><a href="webdev.php" class="nav-link <?php echo $currentPage === 'webdev' ? 'active' : ''; ?>">Web Dev</a></li>
          <li><a href="ai.php" class="nav-link <?php echo $currentPage === 'ai' ? 'active' : ''; ?>">AI &amp; Tech</a></li>
          <li><a href="contact.php" class="nav-link <?php echo $currentPage === 'contact' ? 'active' : ''; ?>">Contact</a></li>
        </ul>

        <!-- Nav Right Actions -->
        <div class="nav-actions">
          <!-- Modern Theme Toggle with Lucide-style SVG Icons -->
          <button type="button" id="themeToggleBtn" class="theme-toggle-btn" onclick="window.toggleTheme ? window.toggleTheme() : null" aria-label="Toggle Color Theme" title="Toggle Light/Dark Theme">
            <!-- Moon Icon (Dark Mode) -->
            <svg class="theme-icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
              <path d="M19 3v4"></path>
              <path d="M21 5h-4"></path>
            </svg>
            <!-- Sun Icon (Light Mode) -->
            <svg class="theme-icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="4"></circle>
              <path d="M12 2v2"></path>
              <path d="M12 20v2"></path>
              <path d="m4.93 4.93 1.41 1.41"></path>
              <path d="m17.66 17.66 1.41 1.41"></path>
              <path d="M2 12h2"></path>
              <path d="M20 12h2"></path>
              <path d="m6.34 17.66-1.41 1.41"></path>
              <path d="m19.07 4.93-1.41 1.41"></path>
            </svg>
          </button>

          <!-- CTA Button -->
          <a href="contact.php" class="btn btn-primary nav-cta-btn">
            <span>Let's Work Together</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>

          <!-- Mobile Hamburger Drawer Toggle -->
          <button id="mobileToggleBtn" class="mobile-toggle-btn" aria-label="Open Navigation Menu" aria-expanded="false">
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>
      </div>
    </nav>
  </header>

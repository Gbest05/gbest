<?php
/**
 * GBEST / GBTech - Admin Panel Header Partial
 * Responsive Mobile-First Architecture
 */

require_once dirname(__DIR__) . '/auth.php';
require_once dirname(__DIR__, 2) . '/includes/config.php';

require_admin_auth();

$siteConfig = get_site_config();
$adminUser = get_admin_user();
$activeAdminNav = $activeAdminNav ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($adminTitle ?? 'Admin Dashboard'); ?> — <?php echo htmlspecialchars($siteConfig['brand_name']); ?> CMS</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/animations.css">
  <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body class="admin-body">
  <!-- Mobile Sidebar Backdrop Overlay -->
  <div id="adminSidebarBackdrop" class="admin-sidebar-backdrop" aria-hidden="true"></div>

  <div class="admin-layout">
    <!-- Sidebar Navigation Drawer -->
    <aside class="admin-sidebar" id="adminSidebar" aria-label="Admin Navigation Sidebar">
      <div class="admin-sidebar-header">
        <a href="../index.php" target="_blank" class="brand-logo" title="View Public Website">
          <div class="brand-icon-box"><?php echo htmlspecialchars($siteConfig['brand_badge']); ?></div>
          <div class="brand-text-wrap">
            <span class="brand-name"><?php echo htmlspecialchars($siteConfig['brand_name']); ?><span>.</span></span>
            <span class="brand-tagline">CMS Dashboard</span>
          </div>
        </a>
        <!-- Mobile Sidebar Close Button -->
        <button id="adminSidebarClose" class="admin-sidebar-close-btn" aria-label="Close Sidebar">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <ul class="admin-nav-list">
        <li>
          <a href="index.php" class="admin-nav-link <?php echo $activeAdminNav === 'dashboard' ? 'active' : ''; ?>">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="pages.php" class="admin-nav-link <?php echo $activeAdminNav === 'pages' ? 'active' : ''; ?>">
            <i class="fa-solid fa-file-lines"></i>
            <span>Page Content &amp; Hero CMS</span>
          </a>
        </li>
        <li>
          <a href="settings.php" class="admin-nav-link <?php echo $activeAdminNav === 'settings' ? 'active' : ''; ?>">
            <i class="fa-solid fa-sliders"></i>
            <span>Site &amp; Landing Settings</span>
          </a>
        </li>
        <li>
          <a href="projects.php" class="admin-nav-link <?php echo $activeAdminNav === 'projects' ? 'active' : ''; ?>">
            <i class="fa-solid fa-laptop-code"></i>
            <span>Manage Web &amp; AI Projects</span>
          </a>
        </li>
        <li>
          <a href="graphics.php" class="admin-nav-link <?php echo $activeAdminNav === 'graphics' ? 'active' : ''; ?>">
            <i class="fa-solid fa-palette"></i>
            <span>Manage Graphics Work</span>
          </a>
        </li>
        <li>
          <a href="messages.php" class="admin-nav-link <?php echo $activeAdminNav === 'messages' ? 'active' : ''; ?>">
            <i class="fa-solid fa-envelope"></i>
            <span>Contact Messages</span>
          </a>
        </li>
      </ul>

      <div class="admin-sidebar-footer">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
          <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--grad-primary); display: flex; align-items: center; justify-content: center; font-weight: 700; color: #FFFFFF; flex-shrink: 0;">
            <?php echo substr($adminUser['name'], 0, 1); ?>
          </div>
          <div style="overflow: hidden;">
            <div style="font-size: 0.875rem; font-weight: 700; white-space: nowrap; text-overflow: ellipsis; color: var(--text-primary);"><?php echo htmlspecialchars($adminUser['name']); ?></div>
            <div style="font-size: 0.75rem; color: var(--accent-cyan);">Administrator</div>
          </div>
        </div>
        <a href="logout.php" class="btn btn-secondary btn-sm" style="width: 100%; justify-content: center;">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>

    <!-- Main Content Panel -->
    <div class="admin-main">
      <header class="admin-topbar">
        <div class="admin-topbar-title">
          <button id="adminMobileToggle" class="btn btn-secondary btn-icon admin-mobile-toggle" aria-label="Toggle Sidebar" aria-expanded="false">
            <i class="fa-solid fa-bars"></i>
          </button>
          <span class="admin-page-title-text"><?php echo htmlspecialchars($adminTitle ?? 'Admin Dashboard'); ?></span>
        </div>

        <div class="admin-topbar-actions">
          <a href="../index.php" target="_blank" class="btn btn-secondary btn-sm" title="View Public Website">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span class="admin-btn-label">View Live Site</span>
          </a>
        </div>
      </header>

      <main class="admin-content-body">

<?php
/**
 * GBEST / GBTech - Admin Login Portal
 * Author: Gbolahan Alade
 */

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once dirname(__DIR__) . '/includes/config.php';

$siteConfig = get_site_config();
$error = '';

if (is_admin_logged_in()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputIdentifier = strtolower(trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    $adminUser = get_admin_user();
    $matchesUser = (strtolower($adminUser['username']) === $inputIdentifier || strtolower($adminUser['email']) === $inputIdentifier);

    if ($matchesUser && password_verify($password, $adminUser['password_hash'])) {
        $_SESSION['gbest_admin_auth'] = true;
        $_SESSION['gbest_admin_user'] = $adminUser['username'];
        $_SESSION['gbest_admin_name'] = $adminUser['name'];

        $adminUser['last_login'] = date('Y-m-d H:i:s');
        save_admin_user($adminUser);

        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid email/username or password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — <?php echo htmlspecialchars($siteConfig['brand_name']); ?> CMS</title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="../<?php echo htmlspecialchars($siteConfig['logo_image'] ?? 'assets/images/icons/favicon.svg'); ?>?v=<?php echo time(); ?>">
  <link rel="shortcut icon" href="../<?php echo htmlspecialchars($siteConfig['logo_image'] ?? 'assets/images/icons/favicon.svg'); ?>?v=<?php echo time(); ?>">

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700;800&family=Syne:wght@700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/animations.css">
  <link rel="stylesheet" href="assets/css/admin.css">

  <!-- Global Theme Toggle Engine -->
  <script src="../assets/js/theme.js"></script>
</head>
<body class="admin-login-body">
  <!-- Top Right Theme Toggle in Login View -->
  <div style="position: absolute; top: 1.25rem; right: 1.25rem; z-index: 10;">
    <button type="button" id="loginThemeToggle" class="theme-toggle-btn" aria-label="Toggle Color Theme" title="Toggle Light/Dark Theme">
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
  </div>

  <div class="glow-orb glow-purple" style="top: 20%; left: 20%; width: 350px; height: 350px;"></div>
  <div class="glow-orb glow-cyan" style="bottom: 20%; right: 20%; width: 400px; height: 400px;"></div>

  <div class="admin-login-card modal-content-anim">
    <div class="admin-login-header">
      <div class="brand-icon-box" style="margin: 0 auto 0.75rem auto; width: 38px; height: 38px; font-size: 1rem;"><?php echo htmlspecialchars($siteConfig['brand_badge']); ?></div>
      <h1 class="admin-login-title"><?php echo htmlspecialchars($siteConfig['brand_name']); ?> CMS Portal</h1>
      <p class="admin-login-subtitle">Sign in to manage portfolio content, graphics, projects &amp; settings</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="admin-alert-error" style="margin-bottom: 1rem; padding: 0.65rem 1rem; font-size: 0.8125rem;">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span><?php echo htmlspecialchars($error); ?></span>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" class="admin-login-form">
      <div class="form-group">
        <label for="username" class="form-label"><i class="fa-solid fa-user" style="margin-right: 6px; color: var(--accent-cyan);"></i> Email or Username</label>
        <input type="text" id="username" name="username" class="form-input" placeholder="Enter your email or username" required autofocus value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" style="padding: 0.65rem 0.95rem;">
      </div>

      <div class="form-group">
        <label for="password" class="form-label"><i class="fa-solid fa-key" style="margin-right: 6px; color: var(--accent-purple);"></i> Password</label>
        <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required style="padding: 0.65rem 0.95rem;">
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem; font-size: 0.9375rem; margin-top: 0.5rem; min-height: 42px;">
        <i class="fa-solid fa-arrow-right-to-bracket"></i>
        <span>Sign In to Dashboard</span>
      </button>
    </form>

    <div class="admin-login-footer">
      <a href="../index.php" class="admin-back-link" style="font-size: 0.8125rem;">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Return to Live Portfolio</span>
      </a>
    </div>
  </div>

  <script src="../assets/js/theme.js"></script>
</body>
</html>

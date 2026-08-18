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
</head>
<body class="admin-login-body">
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
        <input type="text" id="username" name="username" class="form-input" placeholder="Gbestdev05@gmail.com" required autofocus value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" style="padding: 0.65rem 0.95rem;">
      </div>

      <div class="form-group">
        <label for="password" class="form-label"><i class="fa-solid fa-key" style="margin-right: 6px; color: var(--accent-purple);"></i> Password</label>
        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required style="padding: 0.65rem 0.95rem;">
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
      <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.65rem;">
        Default credentials: <strong>admin</strong> / <strong>admin123</strong>
      </div>
    </div>
  </div>
</body>
</html>

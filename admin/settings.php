<?php
/**
 * GBEST / GBTech - Admin Site & Landing Page Settings
 * Author: Gbolahan Alade
 */

$adminTitle = 'Site & Landing Settings';
$activeAdminNav = 'settings';

require_once __DIR__ . '/includes/header.php';

$siteConfig = get_site_config();
$adminUser = get_admin_user();
$alertMessage = '';
$alertType = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'save_settings';

    if ($action === 'save_settings') {
        // Update Brand & Identity
        $siteConfig['brand_name'] = trim($_POST['brand_name'] ?? 'GBEST');
        $siteConfig['brand_tagline'] = trim($_POST['brand_tagline'] ?? 'GBTech Solutions');
        $siteConfig['brand_badge'] = trim($_POST['brand_badge'] ?? 'GB');
        $siteConfig['owner_name'] = trim($_POST['owner_name'] ?? 'Gbolahan Alade');
        $siteConfig['professional_title'] = trim($_POST['professional_title'] ?? '');
        $siteConfig['tagline'] = trim($_POST['tagline'] ?? '');

        // Update Hero
        $siteConfig['hero_badge'] = trim($_POST['hero_badge'] ?? '');
        $siteConfig['hero_title_prefix'] = trim($_POST['hero_title_prefix'] ?? "Hi, I'm");
        $siteConfig['hero_description'] = trim($_POST['hero_description'] ?? '');

        // Parse typewriter roles
        $rolesRaw = trim($_POST['typewriter_roles'] ?? '');
        $rolesArray = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $rolesRaw))));
        if (!empty($rolesArray)) {
            $siteConfig['typewriter_roles'] = array_values($rolesArray);
        }

        // About & Stats
        $siteConfig['about_bio_1'] = trim($_POST['about_bio_1'] ?? '');
        $siteConfig['about_bio_2'] = trim($_POST['about_bio_2'] ?? '');
        $siteConfig['stats']['projects_completed'] = trim($_POST['stat_projects'] ?? '45');
        $siteConfig['stats']['technologies'] = trim($_POST['stat_tech'] ?? '20');
        $siteConfig['stats']['years_experience'] = trim($_POST['stat_years'] ?? '4');
        $siteConfig['stats']['happy_clients'] = trim($_POST['stat_clients'] ?? '35');

        // Contact & Socials
        $siteConfig['contact']['email'] = trim($_POST['contact_email'] ?? '');
        $siteConfig['contact']['phone'] = trim($_POST['contact_phone'] ?? '');
        $siteConfig['contact']['phone_display'] = trim($_POST['contact_phone_display'] ?? '');
        $siteConfig['contact']['location'] = trim($_POST['contact_location'] ?? '');
        $siteConfig['contact']['whatsapp_url'] = trim($_POST['whatsapp_url'] ?? '');

        $siteConfig['socials']['github'] = trim($_POST['social_github'] ?? '');
        $siteConfig['socials']['linkedin'] = trim($_POST['social_linkedin'] ?? '');
        $siteConfig['socials']['twitter'] = trim($_POST['social_twitter'] ?? '');
        $siteConfig['socials']['instagram'] = trim($_POST['social_instagram'] ?? '');
        $siteConfig['socials']['facebook'] = trim($_POST['social_facebook'] ?? '');

        // Profile Image Upload
        if (isset($_FILES['profile_image_file']) && $_FILES['profile_image_file']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = handle_file_upload($_FILES['profile_image_file'], 'brand');
            if ($uploadResult['status'] === 'success') {
                $siteConfig['profile_image'] = $uploadResult['path'];
            } else {
                $alertMessage = 'Settings saved, but profile image upload had an issue: ' . $uploadResult['message'];
                $alertType = 'error';
            }
        }

        // Logo Image Upload
        if (isset($_FILES['logo_image_file']) && $_FILES['logo_image_file']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = handle_file_upload($_FILES['logo_image_file'], 'brand');
            if ($uploadResult['status'] === 'success') {
                $siteConfig['logo_image'] = $uploadResult['path'];
            }
        }

        if (save_site_config($siteConfig)) {
            if (empty($alertMessage)) {
                $alertMessage = 'Site settings, text, and media updated successfully!';
                $alertType = 'success';
            }
        } else {
            $alertMessage = 'Failed to save settings to JSON file. Check folder write permissions.';
            $alertType = 'error';
        }
    } elseif ($action === 'change_password') {
        $currentPass = trim($_POST['current_password'] ?? '');
        $newPass = trim($_POST['new_password'] ?? '');
        $confirmPass = trim($_POST['confirm_password'] ?? '');

        if (password_verify($currentPass, $adminUser['password_hash'])) {
            if (strlen($newPass) >= 6 && $newPass === $confirmPass) {
                $adminUser['password_hash'] = password_hash($newPass, PASSWORD_DEFAULT);
                save_admin_user($adminUser);
                $alertMessage = 'Admin password changed successfully!';
                $alertType = 'success';
            } else {
                $alertMessage = 'New passwords do not match or are shorter than 6 characters.';
                $alertType = 'error';
            }
        } else {
            $alertMessage = 'Current password entered is incorrect.';
            $alertType = 'error';
        }
    }
}
?>

<?php if (!empty($alertMessage)): ?>
  <div class="<?php echo $alertType === 'success' ? 'admin-alert-success' : 'admin-alert-error'; ?>">
    <i class="fa-solid <?php echo $alertType === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>
    <span><?php echo htmlspecialchars($alertMessage); ?></span>
  </div>
<?php endif; ?>

<form method="POST" action="settings.php" enctype="multipart/form-data">
  <input type="hidden" name="action" value="save_settings">

  <!-- 1. Brand Identity & Logo -->
  <div class="admin-card">
    <div class="admin-card-header">
      <h2 class="admin-card-title"><i class="fa-solid fa-gem" style="color: var(--accent-purple); margin-right: 8px;"></i> Brand Identity &amp; Logo</h2>
    </div>

    <div class="admin-form-grid">
      <div class="form-group">
        <label class="form-label">Brand Name (Logo Text)</label>
        <input type="text" name="brand_name" class="form-input" value="<?php echo htmlspecialchars($siteConfig['brand_name']); ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label">Brand Icon Badge (e.g. GB)</label>
        <input type="text" name="brand_badge" class="form-input" value="<?php echo htmlspecialchars($siteConfig['brand_badge']); ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label">Brand Sub-Tagline</label>
        <input type="text" name="brand_tagline" class="form-input" value="<?php echo htmlspecialchars($siteConfig['brand_tagline']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Owner Full Name</label>
        <input type="text" name="owner_name" class="form-input" value="<?php echo htmlspecialchars($siteConfig['owner_name']); ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label">Professional Title</label>
        <input type="text" name="professional_title" class="form-input" value="<?php echo htmlspecialchars($siteConfig['professional_title']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Official Tagline</label>
        <input type="text" name="tagline" class="form-input" value="<?php echo htmlspecialchars($siteConfig['tagline']); ?>">
      </div>
    </div>
  </div>

  <!-- 2. Landing Hero Section & Typewriter -->
  <div class="admin-card">
    <div class="admin-card-header">
      <h2 class="admin-card-title"><i class="fa-solid fa-bullhorn" style="color: var(--accent-cyan); margin-right: 8px;"></i> Hero Section &amp; Typewriter Animation</h2>
    </div>

    <div class="admin-form-grid">
      <div class="form-group">
        <label class="form-label">Hero Badge Text</label>
        <input type="text" name="hero_badge" class="form-input" value="<?php echo htmlspecialchars($siteConfig['hero_badge']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Hero Title Prefix</label>
        <input type="text" name="hero_title_prefix" class="form-input" value="<?php echo htmlspecialchars($siteConfig['hero_title_prefix']); ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="form-label">Hero Description</label>
      <textarea name="hero_description" class="form-textarea" style="min-height: 90px;"><?php echo htmlspecialchars($siteConfig['hero_description']); ?></textarea>
    </div>

    <div class="form-group">
      <label class="form-label">Hero Dynamic Typewriter Roles (One per line)</label>
      <textarea name="typewriter_roles" class="form-textarea" style="min-height: 120px; font-family: var(--font-mono);"><?php echo htmlspecialchars(implode("\n", $siteConfig['typewriter_roles'] ?? [])); ?></textarea>
      <small style="color: var(--text-muted); font-size: 0.8125rem;">Each line will cycle dynamically in the animated hero typewriter.</small>
    </div>

    <div class="admin-form-grid" style="margin-top: 1rem;">
      <div class="form-group" style="min-width: 0;">
        <label class="form-label">Profile Avatar Image</label>
        <input type="file" name="profile_image_file" class="form-input" accept="image/*" data-preview="profilePreviewImg">
        <div style="margin-top: 0.75rem; display: flex; align-items: center; gap: 0.85rem; min-width: 0; flex-wrap: wrap;">
          <img id="profilePreviewImg" src="../<?php echo htmlspecialchars($siteConfig['profile_image']); ?>" alt="Current Profile" style="width: 60px; height: 60px; border-radius: var(--radius-md); object-fit: cover; border: 1px solid var(--border-color); flex-shrink: 0;">
          <small style="color: var(--text-muted); font-size: 0.75rem; word-break: break-all; min-width: 0; flex: 1 1 180px;">Current: <code><?php echo htmlspecialchars($siteConfig['profile_image']); ?></code></small>
        </div>
      </div>

      <div class="form-group" style="min-width: 0;">
        <label class="form-label">Favicon / Logo Image</label>
        <input type="file" name="logo_image_file" class="form-input" accept="image/*" data-preview="logoPreviewImg">
        <div style="margin-top: 0.75rem; display: flex; align-items: center; gap: 0.85rem; min-width: 0; flex-wrap: wrap;">
          <img id="logoPreviewImg" src="../<?php echo htmlspecialchars($siteConfig['logo_image']); ?>" alt="Current Logo" style="width: 45px; height: 45px; border-radius: 8px; object-fit: contain; border: 1px solid var(--border-color); flex-shrink: 0;">
          <small style="color: var(--text-muted); font-size: 0.75rem; word-break: break-all; min-width: 0; flex: 1 1 180px;">Current: <code><?php echo htmlspecialchars($siteConfig['logo_image']); ?></code></small>
        </div>
      </div>
    </div>
  </div>

  <!-- 3. About Narrative & Stats -->
  <div class="admin-card">
    <div class="admin-card-header">
      <h2 class="admin-card-title"><i class="fa-solid fa-user-tie" style="color: var(--accent-amber); margin-right: 8px;"></i> About Narrative &amp; Stats Counters</h2>
    </div>

    <div class="form-group">
      <label class="form-label">About Biography - Paragraph 1</label>
      <textarea name="about_bio_1" class="form-textarea" style="min-height: 80px;"><?php echo htmlspecialchars($siteConfig['about_bio_1']); ?></textarea>
    </div>

    <div class="form-group">
      <label class="form-label">About Biography - Paragraph 2</label>
      <textarea name="about_bio_2" class="form-textarea" style="min-height: 80px;"><?php echo htmlspecialchars($siteConfig['about_bio_2']); ?></textarea>
    </div>

    <div class="admin-form-grid" style="margin-top: 1rem;">
      <div class="form-group">
        <label class="form-label">Projects Completed</label>
        <input type="text" name="stat_projects" class="form-input" value="<?php echo htmlspecialchars($siteConfig['stats']['projects_completed'] ?? '45'); ?>">
      </div>
      <div class="form-group">
        <label class="form-label">Technologies Mastered</label>
        <input type="text" name="stat_tech" class="form-input" value="<?php echo htmlspecialchars($siteConfig['stats']['technologies'] ?? '20'); ?>">
      </div>
      <div class="form-group">
        <label class="form-label">Years of Experience</label>
        <input type="text" name="stat_years" class="form-input" value="<?php echo htmlspecialchars($siteConfig['stats']['years_experience'] ?? '4'); ?>">
      </div>
      <div class="form-group">
        <label class="form-label">Happy Clients</label>
        <input type="text" name="stat_clients" class="form-input" value="<?php echo htmlspecialchars($siteConfig['stats']['happy_clients'] ?? '35'); ?>">
      </div>
    </div>
  </div>

  <!-- 4. Contact Details & Social Channels -->
  <div class="admin-card">
    <div class="admin-card-header">
      <h2 class="admin-card-title"><i class="fa-solid fa-address-book" style="color: var(--accent-emerald); margin-right: 8px;"></i> Contact Details &amp; Social Links</h2>
    </div>

    <div class="admin-form-grid">
      <div class="form-group">
        <label class="form-label">Contact Email</label>
        <input type="email" name="contact_email" class="form-input" value="<?php echo htmlspecialchars($siteConfig['contact']['email']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Phone (Raw Format e.g. +234...)</label>
        <input type="text" name="contact_phone" class="form-input" value="<?php echo htmlspecialchars($siteConfig['contact']['phone']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Phone Display Label</label>
        <input type="text" name="contact_phone_display" class="form-input" value="<?php echo htmlspecialchars($siteConfig['contact']['phone_display']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Location</label>
        <input type="text" name="contact_location" class="form-input" value="<?php echo htmlspecialchars($siteConfig['contact']['location']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">WhatsApp Direct URL</label>
        <input type="text" name="whatsapp_url" class="form-input" value="<?php echo htmlspecialchars($siteConfig['contact']['whatsapp_url']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">GitHub Profile URL</label>
        <input type="text" name="social_github" class="form-input" value="<?php echo htmlspecialchars($siteConfig['socials']['github']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">LinkedIn Profile URL</label>
        <input type="text" name="social_linkedin" class="form-input" value="<?php echo htmlspecialchars($siteConfig['socials']['linkedin']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">X / Twitter URL</label>
        <input type="text" name="social_twitter" class="form-input" value="<?php echo htmlspecialchars($siteConfig['socials']['twitter']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Instagram URL</label>
        <input type="text" name="social_instagram" class="form-input" value="<?php echo htmlspecialchars($siteConfig['socials']['instagram']); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Facebook URL</label>
        <input type="text" name="social_facebook" class="form-input" value="<?php echo htmlspecialchars($siteConfig['socials']['facebook']); ?>">
      </div>
    </div>

    <div style="margin-top: 1.5rem;">
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i>
        <span>Save All Landing &amp; Site Settings</span>
      </button>
    </div>
  </div>
</form>

<!-- 5. Security & Password Settings -->
<div class="admin-card">
  <div class="admin-card-header">
    <h2 class="admin-card-title"><i class="fa-solid fa-lock" style="color: #EF4444; margin-right: 8px;"></i> Change Admin Password</h2>
  </div>

  <form method="POST" action="settings.php">
    <input type="hidden" name="action" value="change_password">
    <div class="admin-form-grid">
      <div class="form-group">
        <label class="form-label">Current Password</label>
        <input type="password" name="current_password" class="form-input" placeholder="••••••••" required>
      </div>
      <div class="form-group">
        <label class="form-label">New Password</label>
        <input type="password" name="new_password" class="form-input" placeholder="••••••••" required minlength="6">
      </div>
      <div class="form-group">
        <label class="form-label">Confirm New Password</label>
        <input type="password" name="confirm_password" class="form-input" placeholder="••••••••" required minlength="6">
      </div>
    </div>
    <div style="margin-top: 1rem;">
      <button type="submit" class="btn btn-secondary" style="border-color: #EF4444; color: #EF4444;">
        <i class="fa-solid fa-key"></i>
        <span>Update Admin Password</span>
      </button>
    </div>
  </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<?php
/**
 * GBEST / GBTech - Admin Dashboard Overview
 * Author: Gbolahan Alade
 */

$adminTitle = 'Dashboard Overview';
$activeAdminNav = 'dashboard';

require_once __DIR__ . '/includes/header.php';

$alertMessage = '';
$alertType = 'success';

// Handle Direct Profile Picture Upload from Dashboard
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'quick_upload_profile') {
    if (isset($_FILES['profile_avatar']) && $_FILES['profile_avatar']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handle_file_upload($_FILES['profile_avatar'], 'brand');
        if ($uploadResult['status'] === 'success') {
            $siteConfig['profile_image'] = $uploadResult['path'];
            if (save_site_config($siteConfig)) {
                $alertMessage = 'Profile picture successfully uploaded and updated across the portfolio!';
                $alertType = 'success';
            } else {
                $alertMessage = 'Image uploaded but failed to update site config JSON.';
                $alertType = 'error';
            }
        } else {
            $alertMessage = 'Profile image upload failed: ' . $uploadResult['message'];
            $alertType = 'error';
        }
    } else {
        $alertMessage = 'Please select a valid image file to upload.';
        $alertType = 'error';
    }
}

$projects = get_projects();
$graphics = get_graphics();
$messages = get_messages();
?>

<?php if (!empty($alertMessage)): ?>
  <div class="<?php echo $alertType === 'success' ? 'admin-alert-success' : 'admin-alert-error'; ?>" style="margin-bottom: 1.5rem;">
    <i class="fa-solid <?php echo $alertType === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>
    <span><?php echo htmlspecialchars($alertMessage); ?></span>
  </div>
<?php endif; ?>

<!-- Admin Profile Header Banner & Quick Avatar Uploader -->
<div class="admin-card" style="background: linear-gradient(135deg, var(--bg-surface) 0%, var(--bg-surface-elevated) 100%); border: 1px solid var(--border-color); margin-bottom: 1.75rem; padding: clamp(1.25rem, 3vw, 1.75rem);">
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
    <!-- Profile Info & Avatar Preview -->
    <div style="display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap;">
      <div style="position: relative; width: 78px; height: 78px; border-radius: 50%; padding: 3px; background: var(--grad-primary); box-shadow: 0 4px 15px rgba(139, 92, 246, 0.35); flex-shrink: 0;">
        <div style="width: 100%; height: 100%; border-radius: 50%; overflow: hidden; background: var(--bg-surface); display: flex; align-items: center; justify-content: center;">
          <?php if (!empty($siteConfig['profile_image']) && file_exists(dirname(__DIR__) . '/' . $siteConfig['profile_image'])): ?>
            <img src="../<?php echo htmlspecialchars($siteConfig['profile_image']); ?>?v=<?php echo filemtime(dirname(__DIR__) . '/' . $siteConfig['profile_image']); ?>" alt="<?php echo htmlspecialchars($siteConfig['owner_name']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
          <?php else: ?>
            <span style="font-size: 1.8rem; font-weight: 800; color: var(--accent-purple);"><?php echo substr($adminUser['name'], 0, 1); ?></span>
          <?php endif; ?>
        </div>
      </div>

      <div style="min-width: 0; flex: 1 1 240px; overflow-wrap: break-word; word-wrap: break-word;">
        <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
          <h2 style="font-size: clamp(1.15rem, 3vw, 1.5rem); font-weight: 800; margin: 0; color: var(--text-primary);"><?php echo htmlspecialchars($siteConfig['owner_name']); ?></h2>
          <span class="badge-tag" style="font-size: 0.6875rem; padding: 0.15rem 0.55rem; margin: 0;">Super Administrator</span>
        </div>
        <p style="font-size: 0.8125rem; color: var(--text-secondary); margin: 0.25rem 0 0.5rem 0; word-break: break-word;"><?php echo htmlspecialchars($siteConfig['professional_title']); ?></p>
        <span style="font-size: 0.72rem; color: var(--text-muted); word-break: break-all; display: inline-block; max-width: 100%;"><i class="fa-solid fa-camera" style="margin-right: 4px;"></i> Current Avatar: <code style="word-break: break-all;"><?php echo htmlspecialchars($siteConfig['profile_image']); ?></code></span>
      </div>
    </div>

    <!-- Quick Photo Upload Form -->
    <div style="background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 1rem 1.25rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); width: 100%; max-width: 100%; box-sizing: border-box;">
      <form method="POST" action="index.php" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap; width: 100%;">
        <input type="hidden" name="action" value="quick_upload_profile">
        <div style="flex: 1 1 180px; min-width: 0;">
          <label class="form-label" style="font-size: 0.8125rem; margin-bottom: 0.35rem; display: block;">
            <i class="fa-solid fa-cloud-arrow-up" style="color: var(--accent-cyan); margin-right: 4px;"></i> <strong>Upload New Profile Picture</strong>
          </label>
          <input type="file" name="profile_avatar" class="form-input" accept="image/*" required style="padding: 0.35rem 0.6rem; font-size: 0.8125rem; width: 100%; max-width: 100%; box-sizing: border-box;">
        </div>
        <button type="submit" class="btn btn-primary btn-sm" style="align-self: flex-end; height: 38px;">
          <i class="fa-solid fa-upload"></i>
          <span>Save Photo</span>
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Metric Stats Overview -->
<div class="admin-stats-grid">
  <div class="admin-stat-box">
    <div class="admin-stat-icon" style="background: rgba(139, 92, 246, 0.15); color: var(--accent-purple);">
      <i class="fa-solid fa-laptop-code"></i>
    </div>
    <div>
      <div class="admin-stat-count"><?php echo count($projects); ?></div>
      <div class="admin-stat-label">Web &amp; AI Projects</div>
    </div>
  </div>

  <div class="admin-stat-box">
    <div class="admin-stat-icon" style="background: rgba(6, 182, 212, 0.15); color: var(--accent-cyan);">
      <i class="fa-solid fa-palette"></i>
    </div>
    <div>
      <div class="admin-stat-count"><?php echo count($graphics); ?></div>
      <div class="admin-stat-label">Graphics Artworks</div>
    </div>
  </div>

  <div class="admin-stat-box">
    <div class="admin-stat-icon" style="background: rgba(245, 158, 11, 0.15); color: var(--accent-amber);">
      <i class="fa-solid fa-envelope"></i>
    </div>
    <div>
      <div class="admin-stat-count"><?php echo count($messages); ?></div>
      <div class="admin-stat-label">Inquiries Received</div>
    </div>
  </div>

  <div class="admin-stat-box">
    <div class="admin-stat-icon" style="background: rgba(16, 185, 129, 0.15); color: var(--accent-emerald);">
      <i class="fa-solid fa-circle-check"></i>
    </div>
    <div>
      <div class="admin-stat-count" style="font-size: 1.35rem; color: var(--accent-emerald);">Online</div>
      <div class="admin-stat-label">Live CMS Status</div>
    </div>
  </div>
</div>

<!-- Quick Shortcuts -->
<div class="admin-card">
  <div class="admin-card-header">
    <h2 class="admin-card-title"><i class="fa-solid fa-bolt" style="color: var(--accent-amber); margin-right: 8px;"></i> Quick Actions</h2>
  </div>
  <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
    <a href="projects.php?action=new" class="btn btn-primary btn-sm">
      <i class="fa-solid fa-plus"></i>
      <span>Add New Project / Web Work</span>
    </a>
    <a href="graphics.php?action=new" class="btn btn-secondary btn-sm" style="border-color: var(--accent-cyan); color: var(--accent-cyan);">
      <i class="fa-solid fa-upload"></i>
      <span>Upload Graphics Design</span>
    </a>
    <a href="pages.php" class="btn btn-secondary btn-sm" style="border-color: var(--accent-purple); color: var(--accent-purple);">
      <i class="fa-solid fa-file-lines"></i>
      <span>Edit Page Content &amp; Hero Images</span>
    </a>
    <a href="settings.php" class="btn btn-secondary btn-sm">
      <i class="fa-solid fa-pen-to-square"></i>
      <span>Edit Brand Logo &amp; Identity</span>
    </a>
    <a href="messages.php" class="btn btn-secondary btn-sm">
      <i class="fa-solid fa-inbox"></i>
      <span>View Inquiries (<?php echo count($messages); ?>)</span>
    </a>
  </div>
</div>

<!-- Recent Inquiries -->
<div class="admin-card">
  <div class="admin-card-header">
    <h2 class="admin-card-title"><i class="fa-solid fa-envelope-open-text" style="color: var(--accent-purple); margin-right: 8px;"></i> Recent Inquiries</h2>
    <a href="messages.php" class="btn btn-secondary btn-sm">View All</a>
  </div>

  <?php if (empty($messages)): ?>
    <div style="text-align: center; padding: 2.5rem 1rem; color: var(--text-muted);">
      <i class="fa-regular fa-envelope" style="font-size: 2.5rem; margin-bottom: 0.75rem; display: block;"></i>
      <p>No messages received yet. Inquiries submitted through the contact form will appear here.</p>
    </div>
  <?php else: ?>
    <div class="admin-table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message Snippet</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (array_slice($messages, 0, 5) as $msg): ?>
            <tr>
              <td><span style="font-family: var(--font-mono); font-size: 0.8125rem;"><?php echo htmlspecialchars($msg['created_at'] ?? 'N/A'); ?></span></td>
              <td><strong><?php echo htmlspecialchars($msg['name'] ?? ''); ?></strong></td>
              <td><a href="mailto:<?php echo htmlspecialchars($msg['email'] ?? ''); ?>" style="color: var(--accent-cyan);"><?php echo htmlspecialchars($msg['email'] ?? ''); ?></a></td>
              <td><?php echo htmlspecialchars($msg['subject'] ?? ''); ?></td>
              <td><span style="color: var(--text-muted);"><?php echo htmlspecialchars(mb_strimwidth($msg['message'] ?? '', 0, 45, '...')); ?></span></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

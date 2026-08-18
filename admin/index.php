<?php
/**
 * GBEST / GBTech - Admin Dashboard Overview
 * Author: Gbolahan Alade
 */

$adminTitle = 'Dashboard Overview';
$activeAdminNav = 'dashboard';

require_once __DIR__ . '/includes/header.php';

$projects = get_projects();
$graphics = get_graphics();
$messages = get_messages();
?>

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
  <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
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

<?php
/**
 * GBEST / GBTech - Admin Contact Messages Inbox
 * Author: Gbolahan Alade
 */

$adminTitle = 'Contact Messages';
$activeAdminNav = 'messages';

require_once __DIR__ . '/includes/header.php';

$messages = get_messages();
$alertMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_msg_id'])) {
    $delId = $_POST['delete_msg_id'];
    $dataFile = GBEST_ROOT . '/data/messages.json';
    if (file_exists($dataFile)) {
        $raw = file_get_contents($dataFile);
        $all = json_decode($raw, true) ?: [];
        $all = array_values(array_filter($all, fn($m) => ($m['id'] ?? '') !== $delId));
        file_put_contents($dataFile, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $messages = get_messages();
        $alertMessage = 'Message removed from inbox.';
    }
}
?>

<?php if (!empty($alertMessage)): ?>
  <div class="admin-alert-success">
    <i class="fa-solid fa-circle-check"></i>
    <span><?php echo htmlspecialchars($alertMessage); ?></span>
  </div>
<?php endif; ?>

<div class="admin-card">
  <div class="admin-card-header">
    <h2 class="admin-card-title"><i class="fa-solid fa-inbox" style="color: var(--accent-purple); margin-right: 8px;"></i> Inquiries Inbox (<?php echo count($messages); ?>)</h2>
  </div>

  <?php if (empty($messages)): ?>
    <div style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
      <i class="fa-regular fa-envelope-open" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
      <p>Your inbox is empty. Client inquiries will be displayed here in real time.</p>
    </div>
  <?php else: ?>
    <div class="admin-table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Date &amp; Time</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message Body</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($messages as $msg): ?>
            <tr>
              <td><span style="font-family: var(--font-mono); font-size: 0.8125rem;"><?php echo htmlspecialchars($msg['created_at'] ?? 'N/A'); ?></span></td>
              <td><strong><?php echo htmlspecialchars($msg['name'] ?? ''); ?></strong></td>
              <td><a href="mailto:<?php echo htmlspecialchars($msg['email'] ?? ''); ?>" style="color: var(--accent-cyan);"><?php echo htmlspecialchars($msg['email'] ?? ''); ?></a></td>
              <td><span style="font-weight: 600;"><?php echo htmlspecialchars($msg['subject'] ?? ''); ?></span></td>
              <td><div style="max-width: 320px; white-space: pre-wrap; font-size: 0.8125rem; color: var(--text-secondary);"><?php echo htmlspecialchars($msg['message'] ?? ''); ?></div></td>
              <td style="text-align: right;">
                <div style="display: flex; gap: 6px; justify-content: flex-end;">
                  <a href="mailto:<?php echo htmlspecialchars($msg['email'] ?? ''); ?>?subject=Re: <?php echo urlencode($msg['subject'] ?? ''); ?>" class="btn btn-secondary btn-sm" title="Reply">
                    <i class="fa-solid fa-reply"></i>
                  </a>
                  <form method="POST" action="messages.php" style="display: inline;" onsubmit="return confirm('Delete this message?');">
                    <input type="hidden" name="delete_msg_id" value="<?php echo htmlspecialchars($msg['id'] ?? ''); ?>">
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

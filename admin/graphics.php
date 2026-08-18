<?php
/**
 * GBEST / GBTech - Admin Graphics Design Management & Uploads
 * Author: Gbolahan Alade
 */

$adminTitle = 'Manage Graphics Work';
$activeAdminNav = 'graphics';

require_once __DIR__ . '/includes/header.php';

$graphics = get_graphics();
$alertMessage = '';
$alertType = 'success';

$editGraphic = null;
$action = $_GET['action'] ?? '';
$editId = $_GET['edit_id'] ?? '';

if ($action === 'edit' && !empty($editId)) {
    foreach ($graphics as $g) {
        if ($g['id'] === $editId) {
            $editGraphic = $g;
            break;
        }
    }
}

// Handle Form Submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAction = $_POST['post_action'] ?? '';

    if ($postAction === 'delete') {
        $deleteId = $_POST['graphic_id'] ?? '';
        $graphics = array_values(array_filter($graphics, fn($item) => $item['id'] !== $deleteId));
        if (save_graphics($graphics)) {
            $alertMessage = 'Graphic design artwork deleted successfully.';
            $alertType = 'success';
        }
    } elseif ($postAction === 'save') {
        $graphicId = trim($_POST['graphic_id'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? 'flyers');
        $categoryLabel = trim($_POST['category_label'] ?? ucfirst($category));
        $client = trim($_POST['client'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $featured = isset($_POST['featured']);

        // Handle Image Upload
        $imagePath = trim($_POST['existing_image'] ?? 'assets/images/graphics/flyer-tech-summit.svg');
        if (isset($_FILES['graphic_image']) && $_FILES['graphic_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = handle_file_upload($_FILES['graphic_image'], 'graphics');
            if ($uploadResult['status'] === 'success') {
                $imagePath = $uploadResult['path'];
            } else {
                $alertMessage = 'Image upload warning: ' . $uploadResult['message'];
                $alertType = 'error';
            }
        }

        if (empty($graphicId)) {
            // New Artwork
            $newGraphic = [
                'id' => 'gfx_' . uniqid(),
                'title' => $title,
                'category' => $category,
                'category_label' => $categoryLabel,
                'client' => $client,
                'description' => $description,
                'image' => $imagePath,
                'featured' => $featured,
                'created_at' => date('Y-m-d')
            ];
            array_unshift($graphics, $newGraphic);
            $alertMessage = 'New graphic artwork uploaded and added to portfolio!';
        } else {
            // Update Existing
            foreach ($graphics as &$g) {
                if ($g['id'] === $graphicId) {
                    $g['title'] = $title;
                    $g['category'] = $category;
                    $g['category_label'] = $categoryLabel;
                    $g['client'] = $client;
                    $g['description'] = $description;
                    $g['image'] = $imagePath;
                    $g['featured'] = $featured;
                    break;
                }
            }
            unset($g);
            $alertMessage = 'Graphic artwork updated successfully!';
        }

        save_graphics($graphics);
        $editGraphic = null;
    }
}
?>

<?php if (!empty($alertMessage)): ?>
  <div class="<?php echo $alertType === 'success' ? 'admin-alert-success' : 'admin-alert-error'; ?>">
    <i class="fa-solid <?php echo $alertType === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>
    <span><?php echo htmlspecialchars($alertMessage); ?></span>
  </div>
<?php endif; ?>

<!-- Top Bar for Graphics Actions -->
<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
  <div>
    <h2 style="font-size: clamp(1.25rem, 3vw, 1.5rem); font-weight: 800; margin-bottom: 0.25rem;">Graphic Design Portfolio (<?php echo count($graphics); ?>)</h2>
    <p style="font-size: 0.875rem; color: var(--text-muted);">Upload brand identity kits, event flyers, logos, and promotional artwork.</p>
  </div>
  <button class="btn btn-primary" onclick="openAdminModal('graphicModal')">
    <i class="fa-solid fa-cloud-arrow-up"></i>
    <span>Upload Graphic Artwork</span>
  </button>
</div>

<!-- Graphics Table -->
<div class="admin-card">
  <div class="admin-table-responsive">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Artwork</th>
          <th>Title &amp; Category</th>
          <th>Client / Brand</th>
          <th>Description</th>
          <th>Date</th>
          <th style="text-align: right;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($graphics)): ?>
          <tr>
            <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">No artwork uploaded yet. Click 'Upload Graphic Artwork' to showcase your designs.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($graphics as $gfx): ?>
            <tr>
              <td>
                <img src="../<?php echo htmlspecialchars($gfx['image']); ?>" alt="<?php echo htmlspecialchars($gfx['title']); ?>" class="admin-table-img" style="aspect-ratio: 4/5; height: 55px; width: 44px;">
              </td>
              <td>
                <div style="font-weight: 700; color: var(--text-primary);"><?php echo htmlspecialchars($gfx['title']); ?></div>
                <span class="badge-tag" style="font-size: 0.7rem; padding: 0.15rem 0.5rem; margin-top: 4px;"><?php echo htmlspecialchars($gfx['category_label'] ?? $gfx['category']); ?></span>
              </td>
              <td>
                <span style="color: var(--accent-cyan); font-weight: 600;"><?php echo htmlspecialchars($gfx['client'] ?? 'Independent Project'); ?></span>
              </td>
              <td>
                <span style="color: var(--text-muted); font-size: 0.8125rem;"><?php echo htmlspecialchars(mb_strimwidth($gfx['description'] ?? '', 0, 50, '...')); ?></span>
              </td>
              <td><span style="font-family: var(--font-mono); font-size: 0.8125rem;"><?php echo htmlspecialchars($gfx['created_at'] ?? ''); ?></span></td>
              <td style="text-align: right;">
                <div class="admin-action-btn-group" style="justify-content: flex-end;">
                  <a href="graphics.php?action=edit&edit_id=<?php echo urlencode($gfx['id']); ?>" class="btn btn-secondary btn-sm" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  <form method="POST" action="graphics.php" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this artwork?');">
                    <input type="hidden" name="post_action" value="delete">
                    <input type="hidden" name="graphic_id" value="<?php echo htmlspecialchars($gfx['id']); ?>">
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Add / Edit Graphic Modal -->
<div id="graphicModal" class="admin-modal <?php echo $editGraphic !== null ? 'active' : ''; ?>">
  <div class="admin-modal-card modal-content-anim">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
      <h3 style="font-size: 1.35rem; font-weight: 800;"><?php echo $editGraphic !== null ? 'Edit Graphic Design' : 'Upload Graphic Artwork'; ?></h3>
      <button class="btn btn-secondary btn-icon" onclick="closeAdminModal('graphicModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <form method="POST" action="graphics.php" enctype="multipart/form-data">
      <input type="hidden" name="post_action" value="save">
      <input type="hidden" name="graphic_id" value="<?php echo htmlspecialchars($editGraphic['id'] ?? ''); ?>">
      <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editGraphic['image'] ?? 'assets/images/graphics/flyer-tech-summit.svg'); ?>">

      <div class="form-group">
        <label class="form-label">Artwork Title <span style="color: #EF4444;">*</span></label>
        <input type="text" name="title" class="form-input" placeholder="e.g. Modern FinTech Brand Identity" value="<?php echo htmlspecialchars($editGraphic['title'] ?? ''); ?>" required>
      </div>

      <div class="admin-form-grid">
        <div class="form-group">
          <label class="form-label">Category</label>
          <select name="category" class="form-input" style="background: var(--input-bg); color: var(--text-primary);">
            <option value="flyers" <?php echo ($editGraphic['category'] ?? '') === 'flyers' ? 'selected' : ''; ?>>Flyers &amp; Print</option>
            <option value="branding" <?php echo ($editGraphic['category'] ?? '') === 'branding' ? 'selected' : ''; ?>>Branding &amp; Identity</option>
            <option value="social" <?php echo ($editGraphic['category'] ?? '') === 'social' ? 'selected' : ''; ?>>Social Media Designs</option>
            <option value="posters" <?php echo ($editGraphic['category'] ?? '') === 'posters' ? 'selected' : ''; ?>>Posters &amp; Art</option>
            <option value="logos" <?php echo ($editGraphic['category'] ?? '') === 'logos' ? 'selected' : ''; ?>>Logos &amp; Marks</option>
            <option value="business" <?php echo ($editGraphic['category'] ?? '') === 'business' ? 'selected' : ''; ?>>Business &amp; Editorial</option>
            <option value="event" <?php echo ($editGraphic['category'] ?? '') === 'event' ? 'selected' : ''; ?>>Event &amp; Entertainment</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Category Badge Label</label>
          <input type="text" name="category_label" class="form-input" placeholder="e.g. Corporate Identity" value="<?php echo htmlspecialchars($editGraphic['category_label'] ?? ''); ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Client / Organization Name</label>
        <input type="text" name="client" class="form-input" placeholder="e.g. GBEST Technologies or Private Client" value="<?php echo htmlspecialchars($editGraphic['client'] ?? ''); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Artwork Image File <span style="color: #EF4444;">*</span></label>
        <input type="file" name="graphic_image" class="form-input" accept="image/*" data-preview="gfxModalPreview">
        <div style="margin-top: 0.75rem;">
          <img id="gfxModalPreview" src="../<?php echo htmlspecialchars($editGraphic['image'] ?? 'assets/images/graphics/flyer-tech-summit.svg'); ?>" alt="Preview" style="max-height: 160px; border-radius: var(--radius-md); object-fit: contain; border: 1px solid var(--border-color);">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Artwork Description</label>
        <textarea name="description" class="form-textarea" placeholder="Creative concept, typography choices, and color psychology used..."><?php echo htmlspecialchars($editGraphic['description'] ?? ''); ?></textarea>
      </div>

      <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
        <button type="button" class="btn btn-secondary" onclick="closeAdminModal('graphicModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-cloud-arrow-up"></i>
          <span>Save Artwork</span>
        </button>
      </div>
    </form>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

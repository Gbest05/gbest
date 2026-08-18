<?php
/**
 * GBEST / GBTech - Admin Project Management & Uploads
 * Author: Gbolahan Alade
 */

$adminTitle = 'Manage Web & AI Projects';
$activeAdminNav = 'projects';

require_once __DIR__ . '/includes/header.php';

$projects = get_projects();
$alertMessage = '';
$alertType = 'success';

$editProject = null;
$action = $_GET['action'] ?? '';
$editId = $_GET['edit_id'] ?? '';

if ($action === 'edit' && !empty($editId)) {
    foreach ($projects as $p) {
        if ($p['id'] === $editId) {
            $editProject = $p;
            break;
        }
    }
}

// Handle Form Submission (Add, Edit, Delete, Quick Toggle)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAction = $_POST['post_action'] ?? '';

    if ($postAction === 'delete') {
        $deleteId = $_POST['project_id'] ?? '';
        $projects = array_values(array_filter($projects, fn($item) => $item['id'] !== $deleteId));
        if (save_projects($projects)) {
            $alertMessage = 'Project deleted successfully.';
            $alertType = 'success';
        }
    } elseif ($postAction === 'toggle_request_access') {
        $toggleId = $_POST['project_id'] ?? '';
        $newState = false;
        foreach ($projects as &$p) {
            if ($p['id'] === $toggleId) {
                $currentState = !isset($p['allow_request_access']) || $p['allow_request_access'] === true || $p['allow_request_access'] === '1' || $p['allow_request_access'] === 1;
                $p['allow_request_access'] = !$currentState;
                $newState = $p['allow_request_access'];
                break;
            }
        }
        unset($p);
        save_projects($projects);
        $alertMessage = 'Request Access button for project ' . ($newState ? 'ENABLED (ON)' : 'DISABLED (OFF)') . '.';
        $alertType = 'success';
    } elseif ($postAction === 'save') {
        $projectId = trim($_POST['project_id'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $category = trim($_POST['category'] ?? 'web');
        $categoryLabel = trim($_POST['category_label'] ?? ucfirst($category));
        $description = trim($_POST['description'] ?? '');
        $demoUrl = trim($_POST['demo_url'] ?? '');
        $githubUrl = trim($_POST['github_url'] ?? '');
        $featured = isset($_POST['featured']);
        $allowRequestAccess = isset($_POST['allow_request_access']);
        $requestAccessLabel = trim($_POST['request_access_label'] ?? 'Request Live Access');
        $requestAccessUrl = trim($_POST['request_access_url'] ?? 'contact.php');

        $techRaw = trim($_POST['technologies'] ?? '');
        $technologies = array_filter(array_map('trim', explode(',', $techRaw)));

        // Handle Image Upload
        $imagePath = trim($_POST['existing_image'] ?? 'assets/images/projects/siwes-system.svg');
        if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = handle_file_upload($_FILES['project_image'], 'projects');
            if ($uploadResult['status'] === 'success') {
                $imagePath = $uploadResult['path'];
            } else {
                $alertMessage = 'Image upload warning: ' . $uploadResult['message'];
                $alertType = 'error';
            }
        }

        if (empty($projectId)) {
            // New Project
            $newProject = [
                'id' => 'proj_' . uniqid(),
                'title' => $title,
                'category' => $category,
                'category_label' => $categoryLabel,
                'description' => $description,
                'technologies' => array_values($technologies),
                'image' => $imagePath,
                'demo_url' => $demoUrl,
                'github_url' => $githubUrl,
                'featured' => $featured,
                'allow_request_access' => $allowRequestAccess,
                'request_access_label' => !empty($requestAccessLabel) ? $requestAccessLabel : 'Request Live Access',
                'request_access_url' => !empty($requestAccessUrl) ? $requestAccessUrl : 'contact.php',
                'created_at' => date('Y-m-d')
            ];
            array_unshift($projects, $newProject); // add to top
            $alertMessage = 'New project created successfully!';
        } else {
            // Update existing project
            foreach ($projects as &$p) {
                if ($p['id'] === $projectId) {
                    $p['title'] = $title;
                    $p['category'] = $category;
                    $p['category_label'] = $categoryLabel;
                    $p['description'] = $description;
                    $p['technologies'] = array_values($technologies);
                    $p['image'] = $imagePath;
                    $p['demo_url'] = $demoUrl;
                    $p['github_url'] = $githubUrl;
                    $p['featured'] = $featured;
                    $p['allow_request_access'] = $allowRequestAccess;
                    $p['request_access_label'] = !empty($requestAccessLabel) ? $requestAccessLabel : 'Request Live Access';
                    $p['request_access_url'] = !empty($requestAccessUrl) ? $requestAccessUrl : 'contact.php';
                    break;
                }
            }
            unset($p);
            $alertMessage = 'Project updated successfully!';
        }

        save_projects($projects);
        $editProject = null;
    }
}
?>

<?php if (!empty($alertMessage)): ?>
  <div class="<?php echo $alertType === 'success' ? 'admin-alert-success' : 'admin-alert-error'; ?>">
    <i class="fa-solid <?php echo $alertType === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>
    <span><?php echo htmlspecialchars($alertMessage); ?></span>
  </div>
<?php endif; ?>

<!-- Top Bar for Project Actions -->
<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
  <div>
    <h2 style="font-size: clamp(1.25rem, 3vw, 1.5rem); font-weight: 800; margin-bottom: 0.25rem;">Web &amp; AI Projects (<?php echo count($projects); ?>)</h2>
    <p style="font-size: 0.875rem; color: var(--text-muted);">Manage web development and deep learning projects, demo links, and visitor request access controls.</p>
  </div>
  <button class="btn btn-primary" onclick="openAdminModal('projectModal')">
    <i class="fa-solid fa-plus"></i>
    <span>Upload New Project</span>
  </button>
</div>

<!-- Projects Table -->
<div class="admin-card">
  <div class="admin-table-responsive">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Preview</th>
          <th>Title &amp; Category</th>
          <th>Request Access Button</th>
          <th>Tech Stack</th>
          <th>Links</th>
          <th>Date</th>
          <th style="text-align: right;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($projects)): ?>
          <tr>
            <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-muted);">No projects found. Click 'Upload New Project' to add your first project.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($projects as $proj): ?>
            <?php 
              $isAccessActive = !isset($proj['allow_request_access']) || $proj['allow_request_access'] === true || $proj['allow_request_access'] === '1' || $proj['allow_request_access'] === 1;
            ?>
            <tr>
              <td>
                <img src="../<?php echo htmlspecialchars($proj['image']); ?>" alt="<?php echo htmlspecialchars($proj['title']); ?>" class="admin-table-img">
              </td>
              <td>
                <div style="font-weight: 700; color: var(--text-primary);"><?php echo htmlspecialchars($proj['title']); ?></div>
                <span class="badge-tag" style="font-size: 0.7rem; padding: 0.15rem 0.5rem; margin-top: 4px;"><?php echo htmlspecialchars($proj['category_label'] ?? $proj['category']); ?></span>
              </td>
              <td>
                <!-- 1-Click Quick Toggle for Request Access Button -->
                <form method="POST" action="projects.php" style="margin: 0; display: inline-block;">
                  <input type="hidden" name="post_action" value="toggle_request_access">
                  <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($proj['id']); ?>">
                  <button type="submit" class="badge-tag" style="cursor: pointer; border-radius: 9999px; font-weight: 600; font-size: 0.72rem; padding: 0.25rem 0.65rem; transition: all 0.2s ease; border: 1px solid <?php echo $isAccessActive ? 'rgba(16, 185, 129, 0.4)' : 'rgba(148, 163, 184, 0.3)'; ?>; background: <?php echo $isAccessActive ? 'rgba(16, 185, 129, 0.14)' : 'rgba(148, 163, 184, 0.12)'; ?>; color: <?php echo $isAccessActive ? '#10B981' : '#94A3B8'; ?>;" title="Click to toggle Request Access button ON/OFF">
                    <i class="fa-solid <?php echo $isAccessActive ? 'fa-toggle-on' : 'fa-toggle-off'; ?>" style="margin-right: 4px;"></i>
                    <?php echo $isAccessActive ? 'Access: ON' : 'Access: OFF'; ?>
                  </button>
                </form>
              </td>
              <td>
                <div style="display: flex; flex-wrap: wrap; gap: 4px; max-width: 200px;">
                  <?php foreach ($proj['technologies'] ?? [] as $t): ?>
                    <span class="tech-tag" style="font-size: 0.7rem; padding: 0.1rem 0.4rem;"><?php echo htmlspecialchars($t); ?></span>
                  <?php endforeach; ?>
                </div>
              </td>
              <td>
                <div style="display: flex; gap: 6px;">
                  <?php if (!empty($proj['demo_url'])): ?>
                    <a href="<?php echo htmlspecialchars($proj['demo_url']); ?>" target="_blank" class="social-pill-link" style="width: 28px; height: 28px; font-size: 0.75rem;" title="Demo"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                  <?php endif; ?>
                  <?php if (!empty($proj['github_url'])): ?>
                    <a href="<?php echo htmlspecialchars($proj['github_url']); ?>" target="_blank" class="social-pill-link" style="width: 28px; height: 28px; font-size: 0.75rem;" title="GitHub"><i class="fa-brands fa-github"></i></a>
                  <?php endif; ?>
                </div>
              </td>
              <td><span style="font-family: var(--font-mono); font-size: 0.8125rem;"><?php echo htmlspecialchars($proj['created_at'] ?? ''); ?></span></td>
              <td style="text-align: right;">
                <div class="admin-action-btn-group" style="justify-content: flex-end;">
                  <a href="projects.php?action=edit&edit_id=<?php echo urlencode($proj['id']); ?>" class="btn btn-secondary btn-sm" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  <form method="POST" action="projects.php" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this project?');">
                    <input type="hidden" name="post_action" value="delete">
                    <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($proj['id']); ?>">
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

<!-- Add / Edit Project Modal -->
<div id="projectModal" class="admin-modal <?php echo $editProject !== null ? 'active' : ''; ?>">
  <div class="admin-modal-card modal-content-anim">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
      <h3 style="font-size: 1.35rem; font-weight: 800;"><?php echo $editProject !== null ? 'Edit Project' : 'Upload New Project'; ?></h3>
      <button class="btn btn-secondary btn-icon" onclick="closeAdminModal('projectModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <form method="POST" action="projects.php" enctype="multipart/form-data">
      <input type="hidden" name="post_action" value="save">
      <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($editProject['id'] ?? ''); ?>">
      <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editProject['image'] ?? 'assets/images/projects/siwes-system.svg'); ?>">

      <div class="form-group">
        <label class="form-label">Project Title <span style="color: #EF4444;">*</span></label>
        <input type="text" name="title" class="form-input" placeholder="e.g. AI-Powered Medical Diagnosis App" value="<?php echo htmlspecialchars($editProject['title'] ?? ''); ?>" required>
      </div>

      <div class="admin-form-grid">
        <div class="form-group">
          <label class="form-label">Category</label>
          <select name="category" class="form-input" style="background: var(--input-bg); color: var(--text-primary);">
            <option value="web" <?php echo ($editProject['category'] ?? '') === 'web' ? 'selected' : ''; ?>>Web Development</option>
            <option value="ai" <?php echo ($editProject['category'] ?? '') === 'ai' ? 'selected' : ''; ?>>AI &amp; Machine Learning</option>
            <option value="software" <?php echo ($editProject['category'] ?? '') === 'software' ? 'selected' : ''; ?>>Software Systems</option>
            <option value="ui" <?php echo ($editProject['category'] ?? '') === 'ui' ? 'selected' : ''; ?>>UI/UX Design</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Category Badge Label</label>
          <input type="text" name="category_label" class="form-input" placeholder="e.g. Full-Stack Web" value="<?php echo htmlspecialchars($editProject['category_label'] ?? ''); ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Technologies (Comma separated)</label>
        <input type="text" name="technologies" class="form-input" placeholder="e.g. PHP, PostgreSQL, Docker, Bootstrap" value="<?php echo htmlspecialchars(implode(', ', $editProject['technologies'] ?? [])); ?>">
      </div>

      <div class="form-group">
        <label class="form-label">Project Thumbnail / Screenshot Image</label>
        <input type="file" name="project_image" class="form-input" accept="image/*" data-preview="projModalPreview">
        <div style="margin-top: 0.75rem;">
          <img id="projModalPreview" src="../<?php echo htmlspecialchars($editProject['image'] ?? 'assets/images/projects/siwes-system.svg'); ?>" alt="Preview" style="max-height: 140px; border-radius: var(--radius-md); object-fit: cover; border: 1px solid var(--border-color);">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Project Description <span style="color: #EF4444;">*</span></label>
        <textarea name="description" class="form-textarea" placeholder="Detailed project overview, problem solved, and technical architecture..." required><?php echo htmlspecialchars($editProject['description'] ?? ''); ?></textarea>
      </div>

      <!-- Visitor 'Request Access' Control Panel Box -->
      <div style="background: var(--bg-surface-elevated); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 1.25rem; margin-bottom: 1.5rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem;">
          <div>
            <span style="font-weight: 700; font-size: 0.9375rem; color: var(--text-primary);"><i class="fa-solid fa-lock-open" style="color: var(--accent-cyan); margin-right: 6px;"></i> Visitor 'Request Access' Button</span>
            <p style="font-size: 0.8125rem; color: var(--text-muted); margin: 0.2rem 0 0 0;">Allow visitors on web development &amp; project pages to see the 'Request Live Access' button.</p>
          </div>
          <?php 
            $editAccessActive = !isset($editProject['allow_request_access']) || $editProject['allow_request_access'] === true || $editProject['allow_request_access'] === '1' || $editProject['allow_request_access'] === 1;
          ?>
          <label style="position: relative; display: inline-flex; align-items: center; cursor: pointer;">
            <input type="checkbox" name="allow_request_access" value="1" <?php echo $editAccessActive ? 'checked' : ''; ?> style="width: 20px; height: 20px; accent-color: var(--accent-cyan); cursor: pointer;">
            <span style="margin-left: 8px; font-weight: 700; font-size: 0.875rem;">Enabled (ON)</span>
          </label>
        </div>

        <div class="admin-form-grid" style="margin-top: 0.75rem;">
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" style="font-size: 0.8125rem;">Button Text / Label</label>
            <input type="text" name="request_access_label" class="form-input" placeholder="e.g. Request Live Access" value="<?php echo htmlspecialchars($editProject['request_access_label'] ?? 'Request Live Access'); ?>">
          </div>
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" style="font-size: 0.8125rem;">Button Destination URL</label>
            <input type="text" name="request_access_url" class="form-input" placeholder="e.g. contact.php or custom link" value="<?php echo htmlspecialchars($editProject['request_access_url'] ?? 'contact.php'); ?>">
          </div>
        </div>
      </div>

      <div class="admin-form-grid">
        <div class="form-group">
          <label class="form-label">Live Demo URL</label>
          <input type="text" name="demo_url" class="form-input" placeholder="https://demo.example.com or webdev.php" value="<?php echo htmlspecialchars($editProject['demo_url'] ?? ''); ?>">
        </div>

        <div class="form-group">
          <label class="form-label">GitHub Repository URL</label>
          <input type="text" name="github_url" class="form-input" placeholder="https://github.com/username/project" value="<?php echo htmlspecialchars($editProject['github_url'] ?? ''); ?>">
        </div>
      </div>

      <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
        <button type="button" class="btn btn-secondary" onclick="closeAdminModal('projectModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-floppy-disk"></i>
          <span>Save Project</span>
        </button>
      </div>
    </form>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<?php
/**
 * GBEST / GBTech - Admin Page Content & Hero Background CMS
 * Author: Gbolahan Alade
 */

$adminTitle = 'Page Content & Hero CMS';
$activeAdminNav = 'pages';

require_once __DIR__ . '/includes/header.php';

$pagesContent = get_pages_content();
$alertMessage = '';
$alertType = 'success';

$allowedPages = [
    'home' => 'Home (Landing Page)',
    'about' => 'About Me Page',
    'skills' => 'Skills & Technologies',
    'services' => 'Services & Offerings',
    'projects' => 'Web & Software Projects',
    'graphics' => 'Graphics Design Portfolio',
    'webdev' => 'Web Dev & Architecture',
    'ai' => 'AI & Deep Tech Page',
    'contact' => 'Contact & Inquiry Page'
];

$activeTab = $_GET['page'] ?? 'home';
if (!array_key_exists($activeTab, $allowedPages)) {
    $activeTab = 'home';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetPage = $_POST['target_page'] ?? 'home';
    if (array_key_exists($targetPage, $allowedPages)) {
        $activeTab = $targetPage;
        
        // Handle hero background image file upload
        if (isset($_FILES['hero_bg_file']) && $_FILES['hero_bg_file']['error'] === UPLOAD_ERR_OK) {
            $uploadRes = handle_file_upload($_FILES['hero_bg_file'], 'hero_bgs');
            if ($uploadRes['status'] === 'success') {
                $pagesContent[$targetPage]['hero_bg_image'] = $uploadRes['path'];
            } else {
                $alertMessage = 'Hero background upload failed: ' . $uploadRes['message'];
                $alertType = 'error';
            }
        } elseif (!empty($_POST['hero_bg_preset'])) {
            $pagesContent[$targetPage]['hero_bg_image'] = trim($_POST['hero_bg_preset']);
        }

        // Generic common fields
        if (isset($_POST['badge'])) $pagesContent[$targetPage]['badge'] = trim($_POST['badge']);
        if (isset($_POST['title'])) $pagesContent[$targetPage]['title'] = trim($_POST['title']);
        if (isset($_POST['subtitle'])) $pagesContent[$targetPage]['subtitle'] = trim($_POST['subtitle']);
        if (isset($_POST['cta_heading'])) $pagesContent[$targetPage]['cta_heading'] = trim($_POST['cta_heading']);
        if (isset($_POST['cta_text'])) $pagesContent[$targetPage]['cta_text'] = trim($_POST['cta_text']);

        // Home specific
        if ($targetPage === 'home') {
            if (isset($_POST['title_prefix'])) $pagesContent['home']['title_prefix'] = trim($_POST['title_prefix']);
            if (isset($_POST['title_name'])) $pagesContent['home']['title_name'] = trim($_POST['title_name']);
            if (isset($_POST['description'])) $pagesContent['home']['description'] = trim($_POST['description']);
            if (isset($_POST['cta_primary_text'])) $pagesContent['home']['cta_primary_text'] = trim($_POST['cta_primary_text']);
            if (isset($_POST['cta_primary_url'])) $pagesContent['home']['cta_primary_url'] = trim($_POST['cta_primary_url']);
            if (isset($_POST['cta_secondary_text'])) $pagesContent['home']['cta_secondary_text'] = trim($_POST['cta_secondary_text']);
            if (isset($_POST['cta_secondary_url'])) $pagesContent['home']['cta_secondary_url'] = trim($_POST['cta_secondary_url']);
        }

        // About specific
        if ($targetPage === 'about') {
            if (isset($_POST['story_heading'])) $pagesContent['about']['story_heading'] = trim($_POST['story_heading']);
            if (isset($_POST['bio_1'])) $pagesContent['about']['bio_1'] = trim($_POST['bio_1']);
            if (isset($_POST['bio_2'])) $pagesContent['about']['bio_2'] = trim($_POST['bio_2']);
            if (isset($_POST['bio_3'])) $pagesContent['about']['bio_3'] = trim($_POST['bio_3']);
        }

        // Contact specific
        if ($targetPage === 'contact') {
            if (isset($_POST['info_heading'])) $pagesContent['contact']['info_heading'] = trim($_POST['info_heading']);
            if (isset($_POST['info_text'])) $pagesContent['contact']['info_text'] = trim($_POST['info_text']);
        }

        if (empty($alertMessage)) {
            save_pages_content($pagesContent);
            $alertMessage = "Content and Hero Background for '{$allowedPages[$targetPage]}' updated successfully!";
            $alertType = 'success';
        }
    }
}

$currentPageData = $pagesContent[$activeTab] ?? [];
?>

<?php if (!empty($alertMessage)): ?>
  <div class="<?php echo $alertType === 'success' ? 'admin-alert-success' : 'admin-alert-error'; ?>">
    <i class="fa-solid <?php echo $alertType === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>
    <span><?php echo htmlspecialchars($alertMessage); ?></span>
  </div>
<?php endif; ?>

<!-- Top Action Header -->
<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
  <div>
    <h2 style="font-size: clamp(1.25rem, 3vw, 1.5rem); font-weight: 800; margin-bottom: 0.25rem;">Multi-Page Content &amp; Hero Background CMS</h2>
    <p style="font-size: 0.875rem; color: var(--text-muted);">Manage titles, hero background images, badges, and narrative text across all navigation pages.</p>
  </div>
  <a href="../<?php echo $activeTab === 'home' ? 'index.php' : $activeTab . '.php'; ?>" target="_blank" class="btn btn-secondary btn-sm" style="border-color: var(--accent-cyan); color: var(--accent-cyan);">
    <i class="fa-solid fa-arrow-up-right-from-square"></i>
    <span>View <?php echo htmlspecialchars($allowedPages[$activeTab]); ?> Live</span>
  </a>
</div>

<!-- Page Selection Tabs -->
<div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.75rem;">
  <?php foreach ($allowedPages as $slug => $label): ?>
    <a href="pages.php?page=<?php echo urlencode($slug); ?>" class="filter-btn <?php echo $activeTab === $slug ? 'active' : ''; ?>" style="text-decoration: none; padding: 0.5rem 1rem;">
      <?php if ($slug === 'home'): ?><i class="fa-solid fa-house" style="margin-right: 4px;"></i>
      <?php elseif ($slug === 'about'): ?><i class="fa-solid fa-user" style="margin-right: 4px;"></i>
      <?php elseif ($slug === 'skills'): ?><i class="fa-solid fa-cubes-stacked" style="margin-right: 4px;"></i>
      <?php elseif ($slug === 'services'): ?><i class="fa-solid fa-layer-group" style="margin-right: 4px;"></i>
      <?php elseif ($slug === 'projects'): ?><i class="fa-solid fa-laptop-code" style="margin-right: 4px;"></i>
      <?php elseif ($slug === 'graphics'): ?><i class="fa-solid fa-palette" style="margin-right: 4px;"></i>
      <?php elseif ($slug === 'webdev'): ?><i class="fa-solid fa-code" style="margin-right: 4px;"></i>
      <?php elseif ($slug === 'ai'): ?><i class="fa-solid fa-brain" style="margin-right: 4px;"></i>
      <?php elseif ($slug === 'contact'): ?><i class="fa-solid fa-envelope" style="margin-right: 4px;"></i>
      <?php endif; ?>
      <span><?php echo htmlspecialchars($label); ?></span>
    </a>
  <?php endforeach; ?>
</div>

<form method="POST" action="pages.php?page=<?php echo urlencode($activeTab); ?>" enctype="multipart/form-data">
  <input type="hidden" name="target_page" value="<?php echo htmlspecialchars($activeTab); ?>">

  <!-- 1. Hero Banner & Background Image Card -->
  <div class="admin-card">
    <div class="admin-card-header">
      <h2 class="admin-card-title">
        <i class="fa-solid fa-image" style="color: var(--accent-purple); margin-right: 8px;"></i>
        Hero Background Image &amp; Visual Header for <?php echo htmlspecialchars($allowedPages[$activeTab]); ?>
      </h2>
    </div>

    <div class="admin-form-grid">
      <div class="form-group">
        <label class="form-label">Upload New Hero Background Image</label>
        <input type="file" name="hero_bg_file" class="form-input" accept="image/*" data-preview="heroBgPreview">
        <small style="color: var(--text-muted); font-size: 0.8125rem; display: block; margin-top: 0.35rem;">Recommended: 1920x600 SVG, WebP, PNG, or JPG high-res image.</small>
      </div>

      <div class="form-group">
        <label class="form-label">Hero Background Image Path / Preset</label>
        <input type="text" name="hero_bg_preset" class="form-input" value="<?php echo htmlspecialchars($currentPageData['hero_bg_image'] ?? "assets/images/hero-bgs/{$activeTab}-hero.svg"); ?>">
      </div>
    </div>

    <!-- Live Preview Box -->
    <div style="margin-top: 1rem; border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border-color); background: #000; position: relative; height: 160px; display: flex; align-items: center; justify-content: center;">
      <img id="heroBgPreview" src="../<?php echo htmlspecialchars($currentPageData['hero_bg_image'] ?? "assets/images/hero-bgs/{$activeTab}-hero.svg"); ?>" alt="Hero Preview" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.65;">
      <div style="position: relative; z-index: 2; text-align: center; color: #FFFFFF; text-shadow: 0 2px 8px rgba(0,0,0,0.8); padding: 1rem;">
        <span class="badge-tag" style="margin-bottom: 0.35rem;"><?php echo htmlspecialchars($currentPageData['badge'] ?? 'Page Badge'); ?></span>
        <div style="font-size: 1.25rem; font-weight: 800;"><?php echo htmlspecialchars($currentPageData['title'] ?? $allowedPages[$activeTab]); ?></div>
      </div>
    </div>
  </div>

  <!-- 2. Header Badges, Headings & Subtitles -->
  <div class="admin-card">
    <div class="admin-card-header">
      <h2 class="admin-card-title">
        <i class="fa-solid fa-heading" style="color: var(--accent-cyan); margin-right: 8px;"></i>
        Page Titles &amp; Narrative Header
      </h2>
    </div>

    <div class="admin-form-grid">
      <div class="form-group">
        <label class="form-label">Top Badge Label</label>
        <input type="text" name="badge" class="form-input" value="<?php echo htmlspecialchars($currentPageData['badge'] ?? ''); ?>" placeholder="e.g. Who I Am / Technical Arsenal">
      </div>

      <?php if ($activeTab === 'home'): ?>
        <div class="form-group">
          <label class="form-label">Hero Title Prefix</label>
          <input type="text" name="title_prefix" class="form-input" value="<?php echo htmlspecialchars($currentPageData['title_prefix'] ?? "Hi, I'm"); ?>">
        </div>

        <div class="form-group">
          <label class="form-label">Hero Full Name</label>
          <input type="text" name="title_name" class="form-input" value="<?php echo htmlspecialchars($currentPageData['title_name'] ?? "Gbolahan Alade"); ?>">
        </div>
      <?php else: ?>
        <div class="form-group">
          <label class="form-label">Main Page Title</label>
          <input type="text" name="title" class="form-input" value="<?php echo htmlspecialchars($currentPageData['title'] ?? ''); ?>" placeholder="e.g. About Gbolahan Alade">
        </div>
      <?php endif; ?>
    </div>

    <?php if ($activeTab === 'home'): ?>
      <div class="form-group">
        <label class="form-label">Hero Main Pitch / Description</label>
        <textarea name="description" class="form-textarea" style="min-height: 85px;"><?php echo htmlspecialchars($currentPageData['description'] ?? ''); ?></textarea>
      </div>

      <div class="admin-form-grid">
        <div class="form-group">
          <label class="form-label">Primary CTA Button Text</label>
          <input type="text" name="cta_primary_text" class="form-input" value="<?php echo htmlspecialchars($currentPageData['cta_primary_text'] ?? 'Explore Projects'); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Primary CTA Button URL</label>
          <input type="text" name="cta_primary_url" class="form-input" value="<?php echo htmlspecialchars($currentPageData['cta_primary_url'] ?? '#projects'); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Secondary CTA Button Text</label>
          <input type="text" name="cta_secondary_text" class="form-input" value="<?php echo htmlspecialchars($currentPageData['cta_secondary_text'] ?? 'Get In Touch'); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Secondary CTA Button URL</label>
          <input type="text" name="cta_secondary_url" class="form-input" value="<?php echo htmlspecialchars($currentPageData['cta_secondary_url'] ?? '#contact'); ?>">
        </div>
      </div>
    <?php else: ?>
      <div class="form-group">
        <label class="form-label">Page Subtitle / Mission Statement</label>
        <textarea name="subtitle" class="form-textarea" style="min-height: 80px;"><?php echo htmlspecialchars($currentPageData['subtitle'] ?? ''); ?></textarea>
      </div>
    <?php endif; ?>

    <!-- Page Specific Fields -->
    <?php if ($activeTab === 'about'): ?>
      <div style="border-top: 1px solid var(--border-color); padding-top: 1.25rem; margin-top: 1.25rem;">
        <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">Biography &amp; Narrative Paragraphs</h3>
        <div class="form-group">
          <label class="form-label">Story Heading</label>
          <input type="text" name="story_heading" class="form-input" value="<?php echo htmlspecialchars($currentPageData['story_heading'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Bio Paragraph 1</label>
          <textarea name="bio_1" class="form-textarea" style="min-height: 80px;"><?php echo htmlspecialchars($currentPageData['bio_1'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Bio Paragraph 2</label>
          <textarea name="bio_2" class="form-textarea" style="min-height: 80px;"><?php echo htmlspecialchars($currentPageData['bio_2'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Bio Paragraph 3 (Core Philosophy)</label>
          <textarea name="bio_3" class="form-textarea" style="min-height: 80px;"><?php echo htmlspecialchars($currentPageData['bio_3'] ?? ''); ?></textarea>
        </div>
      </div>
    <?php endif; ?>

    <?php if (in_array($activeTab, ['services', 'projects', 'graphics', 'webdev', 'ai'])): ?>
      <div style="border-top: 1px solid var(--border-color); padding-top: 1.25rem; margin-top: 1.25rem;">
        <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">Bottom Call-to-Action Box</h3>
        <div class="admin-form-grid">
          <div class="form-group">
            <label class="form-label">CTA Heading</label>
            <input type="text" name="cta_heading" class="form-input" value="<?php echo htmlspecialchars($currentPageData['cta_heading'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label class="form-label">CTA Description</label>
            <input type="text" name="cta_text" class="form-input" value="<?php echo htmlspecialchars($currentPageData['cta_text'] ?? ''); ?>">
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($activeTab === 'contact'): ?>
      <div style="border-top: 1px solid var(--border-color); padding-top: 1.25rem; margin-top: 1.25rem;">
        <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">Contact Card Headers</h3>
        <div class="form-group">
          <label class="form-label">Information Card Heading</label>
          <input type="text" name="info_heading" class="form-input" value="<?php echo htmlspecialchars($currentPageData['info_heading'] ?? 'Contact Information'); ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Information Subtitle Text</label>
          <textarea name="info_text" class="form-textarea" style="min-height: 70px;"><?php echo htmlspecialchars($currentPageData['info_text'] ?? ''); ?></textarea>
        </div>
      </div>
    <?php endif; ?>

    <div style="margin-top: 1.75rem;">
      <button type="submit" class="btn btn-primary" style="padding: 0.85rem 1.75rem;">
        <i class="fa-solid fa-floppy-disk"></i>
        <span>Save <?php echo htmlspecialchars($allowedPages[$activeTab]); ?> Content</span>
      </button>
    </div>
  </div>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

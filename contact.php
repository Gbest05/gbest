<?php
/**
 * GBEST / GBTech - Contact Page & Asynchronous Endpoint
 * Author: Gbolahan Alade
 * Handles GET (Renders Dedicated Contact Page) and POST (Processes Form Submission).
 */

declare(strict_types=1);

if (!defined('GBEST_ROOT')) {
    define('GBEST_ROOT', __DIR__);
}
require_once __DIR__ . '/includes/config.php';

// ==========================================================================
// 1. HANDLE POST (AJAX / Form Submission)
// ==========================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=UTF-8');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');

    $name    = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
    $email   = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
    $subject = isset($_POST['subject']) ? trim(strip_tags($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

    $errors = [];
    if (empty($name) || mb_strlen($name) < 2) {
        $errors[] = 'Please provide a valid full name.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please provide a valid email address.';
    }
    if (empty($subject) || mb_strlen($subject) < 3) {
        $errors[] = 'Please provide a subject for your inquiry.';
    }
    if (empty($message) || mb_strlen($message) < 5) {
        $errors[] = 'Please provide a descriptive message.';
    }

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => implode(' ', $errors)
        ]);
        exit;
    }

    $dataFile = GBEST_ROOT . '/data/messages.json';
    $messages = [];
    if (file_exists($dataFile)) {
        $fileContent = file_get_contents($dataFile);
        if ($fileContent) {
            $decoded = json_decode($fileContent, true);
            if (is_array($decoded)) {
                $messages = $decoded;
            }
        }
    }

    $newMessage = [
        'id'         => uniqid('msg_', true),
        'name'       => $name,
        'email'      => $email,
        'subject'    => $subject,
        'message'    => $message,
        'ip'         => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
        'created_at' => date('Y-m-d H:i:s')
    ];

    $messages[] = $newMessage;
    file_put_contents($dataFile, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Email delivery attempt
    $to = 'alade.gbolahan@gbest.tech';
    $emailSubject = "Portfolio Contact: " . $subject;
    $emailBody = "New inquiry from portfolio:\n\nName: {$name}\nEmail: {$email}\nSubject: {$subject}\n\nMessage:\n{$message}\n";
    $headers = "From: no-reply@gbest.tech\r\nReply-To: {$email}\r\nX-Mailer: PHP/" . phpversion();
    @mail($to, $emailSubject, $emailBody, $headers);

    http_response_code(200);
    echo json_encode([
        'status'  => 'success',
        'message' => 'Thank you, ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '! Your message has been received. Gbolahan will connect with you shortly.'
    ]);
    exit;
}

// ==========================================================================
// 2. HANDLE GET (Render Dedicated Contact Page)
// ==========================================================================
$currentPage = 'contact';
$pageTitle = 'Contact Gbolahan Alade | Get In Touch — GBEST';

require_once __DIR__ . '/includes/header.php';

$pagesContent = get_pages_content();
$pageData = $pagesContent['contact'] ?? [];
?>

<main>
  <!-- Page Header with Dynamic Hero Background Image -->
  <section class="page-hero-banner" style="background-image: url('<?php echo htmlspecialchars($pageData['hero_bg_image'] ?? 'assets/images/hero-bgs/contact-hero.svg'); ?>');">
    <div class="container" style="text-align: center;">
      <span class="badge-tag cyan"><?php echo htmlspecialchars($pageData['badge'] ?? 'Get In Touch'); ?></span>
      <h1 class="section-title" style="font-size: clamp(2rem, 5vw, 3rem); margin-top: 0.5rem;">
        <span class="animated-gradient-text"><?php echo htmlspecialchars($pageData['title'] ?? "Let's Build Something Great Together"); ?></span>
      </h1>
      <p class="section-subtitle" style="max-width: 680px; margin: 0 auto;">
        <?php echo htmlspecialchars($pageData['subtitle'] ?? 'Have a project, freelance inquiry, or technology collaboration in mind? Reach out directly below.'); ?>
      </p>
    </div>
  </section>

  <!-- Contact Form & Details Section -->
  <section class="section-spacing contact-section" style="padding-top: 1rem;">
    <div class="container">
      <div class="contact-layout-grid">
        <!-- Left: Contact Details -->
        <div class="contact-info-card reveal-on-scroll">
          <h2 style="font-size: 1.6rem; margin-bottom: 0.75rem;">Contact Information</h2>
          <p style="font-size: 0.9375rem; margin-bottom: 2rem;">Feel free to reach out directly via email, phone, or any of my social profiles. I typically respond within 24 hours.</p>

          <div class="contact-direct-list">
            <div class="contact-direct-item">
              <div class="direct-icon-wrap"><i class="fa-solid fa-envelope"></i></div>
              <div>
                <div class="direct-label">Email Address</div>
                <a href="mailto:<?php echo htmlspecialchars($siteConfig['contact']['email']); ?>" class="direct-value"><?php echo htmlspecialchars($siteConfig['contact']['email']); ?></a>
              </div>
            </div>

            <div class="contact-direct-item">
              <div class="direct-icon-wrap" style="color: var(--accent-cyan);"><i class="fa-solid fa-phone"></i></div>
              <div>
                <div class="direct-label">Phone / WhatsApp</div>
                <a href="<?php echo htmlspecialchars($siteConfig['contact']['whatsapp_url']); ?>" target="_blank" class="direct-value"><?php echo htmlspecialchars($siteConfig['contact']['phone_display']); ?></a>
              </div>
            </div>

            <div class="contact-direct-item">
              <div class="direct-icon-wrap" style="color: var(--accent-amber);"><i class="fa-solid fa-location-dot"></i></div>
              <div>
                <div class="direct-label">Location</div>
                <div class="direct-value"><?php echo htmlspecialchars($siteConfig['contact']['location']); ?></div>
              </div>
            </div>
          </div>

          <div style="border-top: 1px solid var(--border-light); padding-top: 1.5rem; margin-top: 1.5rem;">
            <span style="display: block; font-size: 0.8125rem; color: var(--text-muted); margin-bottom: 1rem;">Social &amp; Developer Profiles:</span>
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['github']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['twitter']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['socials']['facebook']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="<?php echo htmlspecialchars($siteConfig['contact']['whatsapp_url']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
          </div>
        </div>

        <!-- Right: Asynchronous Contact Form -->
        <div class="contact-form-card reveal-on-scroll reveal-delay-1">
          <h2 style="font-size: 1.6rem; margin-bottom: 1.5rem;">Send a Direct Message</h2>

          <form id="contactForm" method="POST" action="contact.php">
            <div class="form-group">
              <label for="contactName" class="form-label">Your Full Name <span style="color: #EF4444;">*</span></label>
              <input type="text" id="contactName" name="name" class="form-input" placeholder="e.g. Samuel Adeyemi" required autocomplete="name">
            </div>

            <div class="form-group">
              <label for="contactEmail" class="form-label">Your Email Address <span style="color: #EF4444;">*</span></label>
              <input type="email" id="contactEmail" name="email" class="form-input" placeholder="e.g. samuel@example.com" required autocomplete="email">
            </div>

            <div class="form-group">
              <label for="contactSubject" class="form-label">Subject / Service Needed <span style="color: #EF4444;">*</span></label>
              <input type="text" id="contactSubject" name="subject" class="form-input" placeholder="e.g. New Web Platform / Brand Identity Inquiry" required>
            </div>

            <div class="form-group">
              <label for="contactMessage" class="form-label">Your Message <span style="color: #EF4444;">*</span></label>
              <textarea id="contactMessage" name="message" class="form-textarea" placeholder="Tell me about your project, timeline, and goals..." required></textarea>
            </div>

            <button type="submit" id="contactSubmitBtn" class="btn btn-primary" style="width: 100%; padding: 0.95rem;">
              <i class="fa-solid fa-paper-plane"></i>
              <span>Send Message</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

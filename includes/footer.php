<?php
/**
 * GBEST / GBTech - Reusable Modern Footer
 * Author: Gbolahan Alade
 */

$siteConfig = $siteConfig ?? get_site_config();
?>
  <!-- =========================================================================
       FOOTER
       ========================================================================= -->
  <footer class="footer">
    <div class="container">
      <div class="footer-top-grid">
        <!-- Col 1: Brand & Tagline -->
        <div>
          <a href="index.php" class="brand-logo" style="margin-bottom: 1rem;">
            <div class="brand-icon-box"><?php echo htmlspecialchars($siteConfig['brand_badge']); ?></div>
            <div class="brand-text-wrap">
              <span class="brand-name"><?php echo htmlspecialchars($siteConfig['brand_name']); ?><span>.</span></span>
              <span class="brand-tagline"><?php echo htmlspecialchars($siteConfig['brand_tagline']); ?></span>
            </div>
          </a>
          <p style="font-size: 0.9375rem; color: var(--text-secondary); max-width: 320px; margin-bottom: 1.5rem;">
            "<?php echo htmlspecialchars($siteConfig['tagline']); ?>" Creative technologist crafting next-generation digital experiences.
          </p>
          <div style="font-size: 0.8125rem; color: var(--text-muted);">
            <i class="fa-solid fa-location-dot" style="color: var(--accent-cyan); margin-right: 4px;"></i>
            <?php echo htmlspecialchars($siteConfig['contact']['location']); ?>
          </div>
        </div>

        <!-- Col 2: Navigation Links -->
        <div>
          <h4 class="footer-col-title">Navigation</h4>
          <ul class="footer-links-list">
            <li><a href="index.php" class="footer-link">Home</a></li>
            <li><a href="about.php" class="footer-link">About Me</a></li>
            <li><a href="skills.php" class="footer-link">Skills &amp; Tech</a></li>
            <li><a href="services.php" class="footer-link">Services</a></li>
            <li><a href="projects.php" class="footer-link">Featured Projects</a></li>
          </ul>
        </div>

        <!-- Col 3: Portfolios Wings -->
        <div>
          <h4 class="footer-col-title">Portfolio Wings</h4>
          <ul class="footer-links-list">
            <li><a href="graphics.php" class="footer-link">Graphics &amp; Branding</a></li>
            <li><a href="webdev.php" class="footer-link">Web Applications</a></li>
            <li><a href="ai.php" class="footer-link">AI &amp; Deep Tech</a></li>
            <li><a href="contact.php" class="footer-link">Contact &amp; Inquiries</a></li>
          </ul>
        </div>

        <!-- Col 4: Stay Connected & Direct Channels -->
        <div>
          <h4 class="footer-col-title">Stay Connected</h4>
          <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1.25rem;">
            Open for freelance collaborations, engineering roles, and AI research opportunities.
          </p>
          <div style="display: flex; gap: 0.6rem; flex-wrap: wrap;">
            <a href="<?php echo htmlspecialchars($siteConfig['socials']['github']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
            <a href="<?php echo htmlspecialchars($siteConfig['socials']['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="<?php echo htmlspecialchars($siteConfig['socials']['twitter']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="<?php echo htmlspecialchars($siteConfig['socials']['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="<?php echo htmlspecialchars($siteConfig['contact']['whatsapp_url']); ?>" target="_blank" rel="noopener noreferrer" class="social-pill-link" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div>
          &copy; <?php echo date('Y'); ?> <strong><?php echo htmlspecialchars($siteConfig['owner_name']); ?></strong> (<?php echo htmlspecialchars($siteConfig['brand_name']); ?>). All Rights Reserved.
          <a href="admin/login.php" title="Admin Portal" aria-label="Admin Portal" style="font-size: 0.7rem; color: var(--text-muted); opacity: 0.35; margin-left: 10px; text-decoration: none; display: inline-block; vertical-align: middle;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.35'"><i class="fa-solid fa-lock"></i></a>
        </div>
        <div>
          Engineered with Pixel Precision &amp; Clean Modern Architecture.
        </div>
      </div>
    </div>
  </footer>

  <!-- Floating Back to Top Button -->
  <button id="backToTopBtn" class="back-to-top-btn" aria-label="Back to Top" title="Back to top">
    <i class="fa-solid fa-arrow-up"></i>
  </button>

  <!-- Toast Notification Container -->
  <div id="toastContainer" class="toast-container" aria-live="assertive"></div>

  <!-- JavaScript Modules -->
  <script src="assets/js/theme.js"></script>
  <script src="assets/js/typewriter.js"></script>
  <script src="assets/js/counters.js"></script>
  <script src="assets/js/portfolio.js"></script>
  <script src="assets/js/testimonials.js"></script>
  <script src="assets/js/ai-interactive.js"></script>
  <script src="assets/js/contact.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>

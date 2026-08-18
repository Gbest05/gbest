# GBEST / GBTech — Premium Personal Portfolio & CMS

> **"Designing Ideas. Building Technology. Creating Impact."**

Personal portfolio website and custom content management system (CMS) for **Gbolahan Alade** — Graphics Designer, Full-Stack Web Developer, and AI Enthusiast.

---

## 🌟 Features & Highlights

- **Multi-Page Responsive Architecture**: Dedicated pages for About, Skills, Services, Projects, Graphics Design, Web Development, AI & Deep Tech, and Contact.
- **Dynamic Admin CMS Portal**:
  - **Page Content & Hero Background CMS**: Live visual editing for all 9 navigation pages, hero backgrounds, badges, and narrative text.
  - **Landing Page & Brand Settings**: Manage brand logo text, badges, tagline, typewriter animation roles, social channels, and credentials.
  - **Web & AI Project Manager**: Full CRUD for software applications, live demo links, repository URLs, and screenshot uploads.
  - **Graphics Portfolio Manager**: Full CRUD with artwork uploads, categorized taxonomy, and client metadata.
  - **Direct Messages Inbox**: Review, manage, and delete customer inquiries submitted via asynchronous contact forms.
- **Interactive AI Neural Simulator**: Built-in interactive sandbox simulating BERT NLP query routing, GPA predictions, and AI text classification.
- **Interactive Lightbox Modal**: High-resolution artwork gallery with mobile touch-swipe gesture support and category filtering.
- **Modern Design System**:
  - Dark & Light theme switcher with local storage persistence.
  - Custom fluid typography powered by **Space Grotesk**, **Syne**, and **Plus Jakarta Sans**.
  - Mobile-first responsive layout tested across mobile phones, foldables, tablets, and 4K displays.
  - Zero unwanted horizontal scrolling with hardware-accelerated micro-animations.

---

## 🚀 Tech Stack

- **Backend**: PHP 8.0+ (Vanilla, zero-dependency, JSON-based storage engine)
- **Frontend**: HTML5, Modern CSS3 (CSS Variables, Flexbox, Grid, Clamp Typography), Vanilla JavaScript (ES6+)
- **Typography & Icons**: Space Grotesk, Syne, Plus Jakarta Sans, JetBrains Mono, Font Awesome 6
- **Architecture**: Modular partials (`includes/header.php`, `includes/footer.php`, `includes/config.php`)
- **Security**: Bcrypt password hashing, session hardening, strict file extension validation, and sanitization headers.

---

## 📂 Project Structure

```
gbest/
├── index.php               # Dynamic landing page & portfolio overview
├── about.php               # Dedicated About Me narrative & journey timeline
├── skills.php              # Multi-disciplinary technical matrix
├── services.php            # Service offerings & delivery roadmap
├── projects.php            # Full-stack software & AI project showcase
├── graphics.php            # Visual arts & branding portfolio with lightbox
├── webdev.php              # Web architecture & browser mockup showcases
├── ai.php                  # Deep tech & interactive neural inference terminal
├── contact.php             # Asynchronous AJAX contact form & endpoint
├── admin/                  # Secure Admin CMS Portal
│   ├── index.php           # Dashboard metrics & quick shortcuts
│   ├── pages.php           # Page Content & Hero Background CMS
│   ├── settings.php        # Brand, logo, typewriter & landing settings
│   ├── projects.php        # Project manager (CRUD)
│   ├── graphics.php        # Graphics artwork manager (CRUD)
│   ├── messages.php        # Contact inquiries manager
│   ├── login.php           # Non-scrolling authentication portal
│   └── auth.php            # Session validation & admin authentication
├── data/                   # JSON Data Store
│   ├── site_config.json    # Brand identity, socials, stats
│   ├── pages_content.json  # Multi-page hero backgrounds & content
│   ├── projects.json       # Web & AI projects
│   ├── graphics.json       # Graphic design portfolio items
│   ├── messages.json       # Contact messages
│   └── admin_user.json     # Bcrypt hashed admin credentials
├── assets/                 # CSS, JavaScript, SVGs, and Images
│   ├── css/                # style.css & animations.css
│   ├── js/                 # main.js, portfolio.js, theme.js, ai-interactive.js
│   └── images/             # Profile, graphics, hero-bgs, icons, uploads
└── .gitignore              # Standard git exclusion rules
```

---

## ⚙️ Local Development Setup

1. Clone this repository into your local web server root (e.g. `c:/xampp/htdocs/gbest` or `/var/www/html/gbest`):
   ```bash
   git clone https://github.com/Gbest05/gbest.git
   ```
2. Start Apache via **XAMPP / WampServer / LAMP** or run the built-in PHP development server:
   ```bash
   php -S localhost:8000
   ```
3. Open your browser and navigate to:
   - **Public Site**: `http://localhost:8000/` or `http://localhost/gbest/`
   - **Admin Portal**: `http://localhost:8000/admin/` or `http://localhost/gbest/admin/`
4. Default Admin Credentials:
   - **Username**: `admin`
   - **Password**: `admin123` *(Can be updated directly in Admin Settings)*

---

## 👤 Author & Brand

**Gbolahan Alade**
- **Brand**: GBEST / GBTech
- **Role**: Graphics Designer • Web Developer • AI Enthusiast
- **Website**: [gbest.tech](https://gbest.tech)
- **GitHub**: [@Gbest05](https://github.com/Gbest05)

---

## 📄 License

This project is proprietary and open for showcase and portfolio demonstration. All rights reserved © 2026 Gbolahan Alade.

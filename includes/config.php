<?php
/**
 * GBEST / GBTech - Central Configuration & Data Helper Library
 * Author: Gbolahan Alade
 */

declare(strict_types=1);

if (!defined('GBEST_ROOT')) {
    define('GBEST_ROOT', dirname(__DIR__));
}

// --------------------------------------------------------------------------
// 1. Site Configuration
// --------------------------------------------------------------------------
function get_site_config(): array {
    $configFile = GBEST_ROOT . '/data/site_config.json';
    if (file_exists($configFile)) {
        $content = file_get_contents($configFile);
        if ($content) {
            $data = json_decode($content, true);
            if (is_array($data)) {
                return $data;
            }
        }
    }
    // Fallback defaults
    return [
        'brand_name' => 'GBEST',
        'brand_tagline' => 'GBTech Solutions',
        'brand_badge' => 'GB',
        'owner_name' => 'Gbolahan Alade',
        'professional_title' => 'Graphics Designer • Web Developer • AI Enthusiast',
        'tagline' => 'Designing Ideas. Building Technology. Creating Impact.',
        'hero_badge' => 'Available for Freelance & Tech Opportunities',
        'hero_title_prefix' => "Hi, I'm",
        'hero_description' => 'Designing Ideas. Building Technology. Creating Impact. I bridge the gap between creative visual design, robust full-stack software development, and intelligent AI architectures.',
        'typewriter_roles' => [
            'Graphics Designer',
            'Web Developer',
            'AI Enthusiast',
            'Software Developer',
            'Creative Technologist'
        ],
        'profile_image' => 'assets/images/profile.svg',
        'logo_image' => 'assets/images/icons/favicon.svg',
        'about_bio_1' => 'I am Gbolahan Alade, a technology professional and creator operating under the brand GBEST / GBTech.',
        'about_bio_2' => 'With extensive experience spanning brand identity design, responsive web development, REST API systems, and Machine Learning models.',
        'stats' => [
            'projects_completed' => '45',
            'technologies' => '20',
            'years_experience' => '4',
            'happy_clients' => '35'
        ],
        'contact' => [
            'email' => 'alade.gbolahan@gbest.tech',
            'phone' => '+2348000000000',
            'phone_display' => '+234 (Available on WhatsApp)',
            'location' => 'Nigeria (Available for Global Remote)',
            'whatsapp_url' => 'https://wa.me/2348000000000'
        ],
        'socials' => [
            'github' => 'https://github.com/',
            'linkedin' => 'https://linkedin.com/',
            'twitter' => 'https://x.com/',
            'instagram' => 'https://instagram.com/',
            'facebook' => 'https://facebook.com/'
        ]
    ];
}

function save_site_config(array $data): bool {
    $configFile = GBEST_ROOT . '/data/site_config.json';
    return (bool) file_put_contents(
        $configFile,
        json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    );
}

// --------------------------------------------------------------------------
// 2. Projects Data (Web, Software, AI)
// --------------------------------------------------------------------------
function get_projects(?string $category = null, ?int $limit = null): array {
    $file = GBEST_ROOT . '/data/projects.json';
    $projects = [];
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if ($content) {
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                $projects = $decoded;
            }
        }
    }

    if ($category && $category !== 'all') {
        $projects = array_filter($projects, function ($item) use ($category) {
            $cat = strtolower($item['category'] ?? '');
            return str_contains($cat, strtolower($category));
        });
    }

    if ($limit !== null && $limit > 0) {
        $projects = array_slice($projects, 0, $limit);
    }

    return array_values($projects);
}

function save_projects(array $projects): bool {
    $file = GBEST_ROOT . '/data/projects.json';
    return (bool) file_put_contents(
        $file,
        json_encode($projects, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    );
}

// --------------------------------------------------------------------------
// 3. Graphics Design Data
// --------------------------------------------------------------------------
function get_graphics(?string $category = null, ?int $limit = null): array {
    $file = GBEST_ROOT . '/data/graphics.json';
    $graphics = [];
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if ($content) {
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                $graphics = $decoded;
            }
        }
    }

    if ($category && $category !== 'all') {
        $graphics = array_filter($graphics, function ($item) use ($category) {
            $cat = strtolower($item['category'] ?? '');
            return str_contains($cat, strtolower($category));
        });
    }

    if ($limit !== null && $limit > 0) {
        $graphics = array_slice($graphics, 0, $limit);
    }

    return array_values($graphics);
}

function save_graphics(array $graphics): bool {
    $file = GBEST_ROOT . '/data/graphics.json';
    return (bool) file_put_contents(
        $file,
        json_encode($graphics, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    );
}

// --------------------------------------------------------------------------
// 4. Contact Messages Data
// --------------------------------------------------------------------------
function get_messages(): array {
    $file = GBEST_ROOT . '/data/messages.json';
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if ($content) {
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                return array_reverse($decoded); // latest first
            }
        }
    }
    return [];
}

// --------------------------------------------------------------------------
// 5. Secure File Upload Handler
// --------------------------------------------------------------------------
function handle_file_upload(array $file, string $targetSubDir, array $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'webp', 'gif']): array {
    if (!isset($file['error']) || is_array($file['error'])) {
        return ['status' => 'error', 'message' => 'Invalid file parameter.'];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['status' => 'error', 'message' => 'Upload error code: ' . $file['error']];
    }

    // Max 10MB
    if ($file['size'] > 10 * 1024 * 1024) {
        return ['status' => 'error', 'message' => 'File size exceeds 10MB limit.'];
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExtensions, true)) {
        return ['status' => 'error', 'message' => 'Disallowed file extension: ' . htmlspecialchars($ext)];
    }

    $destinationDir = GBEST_ROOT . '/assets/images/uploads/' . trim($targetSubDir, '/');
    if (!is_dir($destinationDir)) {
        mkdir($destinationDir, 0755, true);
    }

    $newFileName = uniqid('upload_', true) . '.' . $ext;
    $destinationPath = $destinationDir . '/' . $newFileName;

    if (!move_uploaded_file($file['tmp_name'], $destinationPath)) {
        return ['status' => 'error', 'message' => 'Failed to move uploaded file.'];
    }

    $relativePath = 'assets/images/uploads/' . trim($targetSubDir, '/') . '/' . $newFileName;
    return ['status' => 'success', 'path' => $relativePath];
}

// --------------------------------------------------------------------------
// 6. Multi-Page Dynamic Content & Hero Backgrounds Helper
// --------------------------------------------------------------------------
function get_pages_content(): array {
    $file = GBEST_ROOT . '/data/pages_content.json';
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if ($content) {
            $data = json_decode($content, true);
            if (is_array($data)) {
                return $data;
            }
        }
    }
    return [
        'home' => ['hero_bg_image' => 'assets/images/hero-bgs/home-hero.svg'],
        'about' => ['hero_bg_image' => 'assets/images/hero-bgs/about-hero.svg'],
        'skills' => ['hero_bg_image' => 'assets/images/hero-bgs/skills-hero.svg'],
        'services' => ['hero_bg_image' => 'assets/images/hero-bgs/services-hero.svg'],
        'projects' => ['hero_bg_image' => 'assets/images/hero-bgs/projects-hero.svg'],
        'graphics' => ['hero_bg_image' => 'assets/images/hero-bgs/graphics-hero.svg'],
        'webdev' => ['hero_bg_image' => 'assets/images/hero-bgs/webdev-hero.svg'],
        'ai' => ['hero_bg_image' => 'assets/images/hero-bgs/ai-hero.svg'],
        'contact' => ['hero_bg_image' => 'assets/images/hero-bgs/contact-hero.svg']
    ];
}

function save_pages_content(array $data): bool {
    $file = GBEST_ROOT . '/data/pages_content.json';
    return (bool) file_put_contents(
        $file,
        json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    );
}

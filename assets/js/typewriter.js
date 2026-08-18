/**
 * GBEST / GBTech - Hero Typewriter Effect
 * Cycles through professional titles with smooth natural typing, pauses, and backspacing.
 * Reads dynamic roles from data-roles attribute if provided by CMS.
 */

document.addEventListener('DOMContentLoaded', () => {
  const typewriterElement = document.getElementById('typewriterText');
  if (!typewriterElement) return;

  let roles = [
    'Graphics Designer',
    'Web Developer',
    'AI Enthusiast',
    'Software Developer',
    'Creative Technologist'
  ];

  // Check for dynamic roles from CMS
  const rawRoles = typewriterElement.getAttribute('data-roles');
  if (rawRoles) {
    try {
      const parsed = JSON.parse(rawRoles);
      if (Array.isArray(parsed) && parsed.length > 0) {
        roles = parsed;
      }
    } catch (e) {
      console.warn('Failed to parse dynamic roles:', e);
    }
  }

  let roleIndex = 0;
  let charIndex = 0;
  let isDeleting = false;
  let typingSpeed = 95; // ms per char

  function typeCycle() {
    const currentRole = roles[roleIndex];

    if (isDeleting) {
      // Removing characters
      typewriterElement.textContent = currentRole.substring(0, charIndex - 1);
      charIndex--;
      typingSpeed = 45; // Faster when backspacing
    } else {
      // Adding characters
      typewriterElement.textContent = currentRole.substring(0, charIndex + 1);
      charIndex++;
      typingSpeed = 90; // Natural typing speed
    }

    if (!isDeleting && charIndex === currentRole.length) {
      // Completed full word, pause before deleting
      typingSpeed = 1800; // Pause at end of word
      isDeleting = true;
    } else if (isDeleting && charIndex === 0) {
      // Completed deleting, switch to next word
      isDeleting = false;
      roleIndex = (roleIndex + 1) % roles.length;
      typingSpeed = 450; // Pause before typing next word
    }

    setTimeout(typeCycle, typingSpeed);
  }

  // Initial delay before starting animation
  setTimeout(typeCycle, 800);
});

import "./style/app.css";

const spotlight = document.getElementById("spotlight");

document.addEventListener("mousemove", (e) => {
  spotlight.style.left = `${e.clientX}px`;
  spotlight.style.top = `${e.clientY}px`;
});

const header = document.querySelector(".header");

let lastScrollY = window.scrollY;

window.addEventListener("scroll", () => {
  const currentScroll = window.scrollY;

  if (currentScroll > lastScrollY && currentScroll > 80) {
    // Scroll down
    header.classList.remove("header-show");
    header.classList.add("header-hide");
  } else {
    // Scroll up
    header.classList.remove("header-hide");
    header.classList.add("header-show");
  }

  lastScrollY = currentScroll;
});

// Animate partner logos on scroll
  const partnerCards = document.querySelectorAll('.partner-card');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = 1;
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });

  partnerCards.forEach((card, index) => {
    card.style.opacity = 0;
    card.style.transform = 'translateY(20px)';
    card.style.transition = `all 0.5s ease ${index * 0.1}s`;
    observer.observe(card);
  });

  // Tooltip positioning for mobile
  function adjustTooltips() {
    if (window.innerWidth < 768) {
      document.querySelectorAll('.partner-tooltip').forEach(tooltip => {
        const card = tooltip.parentElement;
        const cardRect = card.getBoundingClientRect();
        
        if (cardRect.top < 100) {
          tooltip.style.top = 'auto';
          tooltip.style.bottom = '-8px';
        } else {
          tooltip.style.top = '-8px';
          tooltip.style.bottom = 'auto';
        }
      });
    }
  }

  window.addEventListener('resize', adjustTooltips);
  adjustTooltips();
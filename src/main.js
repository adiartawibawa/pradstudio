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

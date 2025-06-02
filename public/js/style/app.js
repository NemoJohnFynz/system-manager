window.addEventListener('DOMContentLoaded', () => {
  const navbar = document.getElementById("main_navbar");
  const layoutContent = document.getElementById("layout-main-content");

  if (navbar && layoutContent) {
    const navbarHeight = navbar.offsetHeight;
    layoutContent.style.marginTop = `${navbarHeight}px`;
  }
});

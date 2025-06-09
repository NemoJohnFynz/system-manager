 function updateMainContentMargin() {
  const navbar = document.getElementById("main_navbar");
  const mainContent = document.getElementById("layout-main-content");
  if (navbar && mainContent) {
    mainContent.style.marginTop = `${navbar.offsetHeight}px`;
  }
}
console.log("Danh sách quyền:", window.permissionsRoute);
console.log("Quyền của bản thân:", window.userPermissionCodes);

window.addEventListener("DOMContentLoaded", updateMainContentMargin);
window.addEventListener("resize", updateMainContentMargin);



// Selecting the sidebar and buttons
const sidebar = document.querySelector(".sidebar");
const sidebarOpenBtn = document.querySelector("#sidebar-open");
const sidebarCloseBtn = document.querySelector("#sidebar-close");
const navbar = document.querySelector(".navbar");
console.log('Navbar:', navbar);
console.log('Sidebar:', sidebar);
const sidebarLockBtn = document.querySelector("#lock-icon"); 
const toggleLock = () => {
  sidebar.classList.toggle("locked"); 
  if (!sidebar.classList.contains("locked")) {
    sidebar.classList.add("hoverable");
    sidebarLockBtn.classList.replace("bx-lock-alt", "bx-lock-open-alt");
  } else {
    sidebar.classList.remove("hoverable");
    sidebarLockBtn.classList.replace("bx-lock-open-alt", "bx-lock-alt");
  }
}; 
const hideSidebar = () => {
  console.log('Mouse left sidebar');
  if (sidebar.classList.contains("hoverable")&& !sidebar.classList.contains("locked")) {
    sidebar.classList.add("close");
  }
}; 
const showSidebar = () => { 
   if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
   }
}; 
const toggleSidebar = () => {
  sidebar.classList.toggle("close");
}; 
if (window.innerWidth < 800) {
  sidebar.classList.add("close");
  sidebar.classList.remove("locked");
  sidebar.classList.remove("hoverable");
}else {
  sidebar.classList.add("hoverable");
} 
sidebarLockBtn.addEventListener("click", toggleLock);
sidebar.addEventListener("mouseleave", hideSidebar);
sidebar.addEventListener("mouseenter", showSidebar);
sidebarOpenBtn.addEventListener("click", toggleSidebar);
sidebarCloseBtn.addEventListener("click", toggleSidebar);
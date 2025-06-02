// Selecting the sidebar and buttons
const sidebar = document.querySelector(".sidebar");
const sidebarOpenBtn = document.querySelector("#sidebar-open");
const sidebarCloseBtn = document.querySelector("#sidebar-close");
const navbar = document.querySelector(".navbar"); 
const sidebarLockBtn = document.querySelector("#lock-icon"); 

// Load sidebar lock state from sessionStorage
const savedLockState = sessionStorage.getItem("sidebarLocked");
if (savedLockState === "true") {
  sidebar.classList.add("locked");
  sidebar.classList.remove("hoverable");
  sidebarLockBtn.classList.replace("bx-lock-open-alt", "bx-lock-alt");
} else {
  sidebar.classList.remove("locked");
  sidebar.classList.add("hoverable");
  sidebarLockBtn.classList.replace("bx-lock-alt", "bx-lock-open-alt");
}

const toggleLock = () => {
  sidebar.classList.toggle("locked"); 
  const isLocked = sidebar.classList.contains("locked");
  
  if (!isLocked) {
    sidebar.classList.add("hoverable");
    sidebarLockBtn.classList.replace("bx-lock-alt", "bx-lock-open-alt");
  } else {
    sidebar.classList.remove("hoverable");
    sidebarLockBtn.classList.replace("bx-lock-open-alt", "bx-lock-alt");
  }

  // Save lock state to sessionStorage
  sessionStorage.setItem("sidebarLocked", isLocked);
};

const hideSidebar = () => {
  if (sidebar.classList.contains("hoverable") && !sidebar.classList.contains("locked")) {
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

// Responsive default behavior
if (window.innerWidth < 800) {
  sidebar.classList.add("close");
  sidebar.classList.remove("locked");
  sidebar.classList.remove("hoverable");
} else {
  if (!sidebar.classList.contains("locked")) {
    sidebar.classList.add("hoverable");
  }
} 

// Event listeners
sidebarLockBtn.addEventListener("click", toggleLock);
sidebar.addEventListener("mouseleave", hideSidebar);
sidebar.addEventListener("mouseenter", showSidebar);
sidebarOpenBtn.addEventListener("click", toggleSidebar);
sidebarCloseBtn.addEventListener("click", toggleSidebar);

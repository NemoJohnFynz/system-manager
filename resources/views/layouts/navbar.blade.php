<link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
<script src="script.js" defer></script>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }

  body {
    min-height: 100vh;
  }

  .flex {
    display: flex;
    align-items: center;
  }

  .nav_image {
    display: flex;
    min-width: 55px;
    justify-content: center;
  }

  .nav_image img {
    height: 35px;
    width: 35px;
    border-radius: 50%;
    object-fit: cover;
  }

  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 270px;
    background: #fff;
    padding: 15px 10px;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
    transition: all 0.4s ease;
    z-index: 999;
    box-shadow: #aaa 0px 0px 3px;
    /* Ensure sidebar is above content */
  }

  .sidebar.close {
    width: calc(55px + 20px);
  }

  .logo_items {
    gap: 8px;
  }

  .logo_name {
    font-size: 22px;
    color: #333;
    font-weight: 500px;
    transition: all 0.3s ease;
  }

  .sidebar.close .logo_name,
  .sidebar.close #lock-icon,
  .sidebar.close #sidebar-close {
    opacity: 0;
    pointer-events: none;
  }

  #lock-icon,
  #sidebar-close {
    padding: 10px;
    color: #4070f4;
    font-size: 25px;
    cursor: pointer;
    margin-left: -4px;
    transition: all 0.3s ease;
  }

  #sidebar-close {
    display: none;
    color: #333;
  }

  .menu_container {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-top: 40px;
    overflow-y: auto;
    height: calc(100% - 82px);
  }

  .menu_container::-webkit-scrollbar {
    display: none;
  }

  .menu_title {
    position: relative;
    height: 50px;
    width: 55px;
  }

  .menu_title .title {
    margin-left: 15px;
    transition: all 0.3s ease;
  }

  .sidebar.close .title {
    opacity: 0;
  }

  .menu_title .line {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    height: 3px;
    width: 20px;
    border-radius: 25px;
    background: #aaa;
    transition: all 0.3s ease;
  }

  .menu_title .line {
    opacity: 0;
  }

  .sidebar.close .line {
    opacity: 1;
  }

  .item {
    list-style: none;
  }

  .link {
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 8px;
    color: #707070;
    display: flex;
    /* Added to make link content align with icon */
    align-items: center;
    /* Added to make link content align with icon */
  }

  .link:hover {
    color: #fff;
    background-color: #4070f4;
  }

  .link span {
    white-space: nowrap;
  }

  .link i {
    height: 50px;
    min-width: 55px;
    display: flex;
    font-size: 22px;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
  }

  .sidebar_profile {
    padding-top: 15px;
    margin-top: 15px;
    gap: 15px;
    border-top: 2px solid rgba(0, 0, 0, 0.1);
  }

  .sidebar_profile .name {
    font-size: 18px;
    color: #333;
  }

  .sidebar_profile .email {
    font-size: 15px;
    color: #333;
  }

  /* Navbar */

  .navbar {
    width: calc(100% - 270px);
    box-shadow: gray 0px 0px 3px;
    /* Initial width for navbar */
    position: fixed;
    top: 0;
    left: 270px;
    /* Initial left position for navbar */
    padding: 10px 20px;
    justify-content: space-between;
    background: #fff;
    /* Added background to navbar */
    transition: all 0.4s ease;
    z-index: 998;
    /* Ensure navbar is below sidebar but above content */
  }



  #sidebar-open {
    font-size: 30px;
    color: #333;
    cursor: pointer;
    margin-right: 20px;
    display: none;
  }

  .search_box {
    height: 46px;
    max-width: 500px;
    width: 100%;
    border: 1px solid #aaa;
    outline: none;
    border-radius: 8px;
    padding: 0 15px;
    font-size: 18px;
    color: #333;
  }

  .navbar img {
    height: 40px;
    width: 40px;
  }

  /* Main Content Area */
  .main-content {
    margin-top: 60px;
    /* Space for the fixed navbar */
    margin-left: 270px;
    /* Initial margin for the open sidebar */
    padding: 20px;
    transition: all 0.4s ease;
    width: calc(100% - 270px);
    /* Initial width for content */
  }

  .sidebar.close~.main-content {
    margin-left: calc(55px + 20px);
    /* Adjust content margin when sidebar is closed */
    width: calc(100% - (55px + 20px));
    /* Adjust content width when sidebar is closed */
  }

  .sidebar.close~.navbar {
    left: calc(55px + 20px);
    width: calc(100% - (55px + 20px));
  }

  /* Responsive */
  @media screen and (max-width: 1100px) {

    /* 
        .sidebar.close~.navbar {
            left: calc(55px + 20px);
            width: calc(100% - (55px + 20px));
        } */
    .sidebar.close~.navbar {
      left: calc(0px);
      width: calc(100%);
    }

    .main-content {
      margin-left: 270px;
      width: calc(100% - 270px);
    }

    .sidebar.close~.main-content {
      margin-left: calc(55px + 20px);
      width: calc(100% - (55px + 20px));
    }
  }

  @media screen and (max-width: 800px) {
    .sidebar {
      left: 0;
      z-index: 1000;
    }

    .sidebar.close {
      left: -100%;
    }

    #sidebar-close {
      display: block;
    }

    #lock-icon {
      display: none;
    }

    .navbar {
      left: 0;
      max-width: 100%;
      transform: translateX(0%);
      width: 100%;
      /* Full width when sidebar is hidden */
    }

    #sidebar-open {
      display: block;
    }

    .main-content {
      margin-left: 0;
      /* No margin when sidebar is hidden */
      width: 100%;
      /* Full width when sidebar is hidden */
    }

    .sidebar.close~.main-content {
      margin-left: 0;
      width: 100%;
    }
  }
</style>

<body>
  <nav class="sidebar locked">
    <div class="logo_items flex">
      <a
        style="scale: 2"
        href="/login" class="nav_image">
        <img src="images/logo.png" alt="logo_img" />
      </a>
      <span class="logo_name">CodingNepal</span>
      <i class="bx bx-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
      <i class="bx bx-x" id="sidebar-close"></i>
    </div>
    <div class="menu_container">
      <div class="menu_items">
        <ul class="menu_item">
          <div class="menu_title flex">
            <span class="title">Dashboard</span>
            <span class="line"></span>
          </div>
          <li class="item">
            <a href="#" class="link flex">
              <i class="bx bx-home-alt"></i>
              <span>Overview</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="link flex">
              <i class="bx bx-grid-alt"></i>
              <span>Users</span>
            </a>
          </li>
        </ul>
        <ul class="menu_item">
          <div class="menu_title flex">
            <span class="title">Manager</span>
            <span class="line"></span>
          </div>

          <li class="item">
            <a href="#" class="link flex">
              <i class="bx"><svg
                  style="width: 22px;height: 22px;"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                </svg></i>
              <span>hardware</span>
            </a>
          </li>

          <li class="item">
            <a href="#" class="link flex">
              <i class="bx bx-cloud-upload"></i>
              <span>SoftWare</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="link flex">
              <i class="bx bx-folder"></i>
              <span> SoftWare File</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="link flex">
              <i class="bx bxs-magic-wand"></i>
              <span>rule</span>
            </a>
          </li>
        </ul>
        <ul class="menu_item">
          <div class="menu_title flex">
            <span class="title">Setting</span>
            <span class="line"></span>
          </div>
          <li class="item">
            <a href="#" class="link flex">
              <i class="bx bx-flag"></i>
              <span>Notice Board</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="link flex">
              <i class="bx bx-award"></i>
              <span>Award</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="link flex">
              <i class="bx bx-cog"></i>
              <span>Setting</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="sidebar_profile flex">
        <span class="nav_image">
          <img src="images/profile.jpg" alt="logo_img" />
        </span>
        <div class="data_text">
          <span class="name">David Oliva</span>
          <span class="email">david@gmail.com</span>
        </div>
      </div>
    </div>
  </nav>
  <nav class="navbar flex">
    <i class="bx bx-menu" id="sidebar-open"></i>
    <input type="text" placeholder="Search..." class="search_box" />
    <span class="nav_image">
      <img src="images/profile.jpg" alt="logo_img" />
    </span>
  </nav>

  <main class="main-content">
    @yield('content')

  </main>

</body>

<script src="{{ asset('js/style/bar/bar.js') }}"></script>
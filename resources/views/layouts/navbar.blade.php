<head>
  <link flex href="css/layouts/nav.css" rel="stylesheet" />
  <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
  <nav class="sidebar locked">
    <div class="logo_items flex">
      <a
        style="scale: 2"
        href="/login" class="nav_image">
        <img src="images/logo.png" alt="logo_img" />
      </a>
      <span class="logo_name">SystemMNG</span>
      <i class="bx bx-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
      <i class="bx bx-x" id="sidebar-close"></i>
    </div>
    <div class="menu_container">
      <div class="menu_items">
        <ul class="menu_item">
          <div class="sidebar_profile flex">
            <span class="nav_image">
              <img src="images/profile.jpg" alt="logo_img" />
            </span>
            <div class="data_text">
              <span class="name">David Oliva</span>
              <span class="email">david@gmail.com</span>
            </div>
          </div>
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
            <a href="/user_list" class="link flex">
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
            <a href="/hardware_manager" class="link flex">
              <i class="bx"><svg
                  style="width: 22px;height: 22px;"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                </svg></i>
              <span>hardware</span>
            </a>
          </li>

          <li class="item">
            <a href="/software_manager" class="link flex">
              <i class="bx bx-cloud-upload"></i>
              <span>SoftWare</span>
            </a>
          </li>
          <li class="item">
            <a href="/software_detail" class="link flex">
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

    </div>
  </nav>
  <nav class="navbar flex">
    <i class="bx bx-menu" id="sidebar-open"></i>
    <input type="text" placeholder="Search..." class="search_box" />
    <span class="nav_image">
      <img src="images/profile.jpg" alt="logo_img" />
    </span>
  </nav>
</body>

<script src="{{ asset('js/style/bar/bar.js') }}"></script>
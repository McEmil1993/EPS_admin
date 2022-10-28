<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./images/download.jpg" alt="EPS Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">EPS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $_SESSION['img_url'] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['user_name'] ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item" id="dashboard">
            <a href="index.php" class="nav-link" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item" id="schedule">
            <a href="schedule.php" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Schedule
              </p>
            </a>
          </li>
           <li class="nav-item" id="building">
            <a href="buildings.php" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Building
              </p>
            </a>
          </li>
           <li class="nav-item" id="category">
            <a href="category.php" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Category
              </p>
            </a>
          </li>
           <li class="nav-item" id="equip">
            <a href="equipment.php" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Equipment
              </p>
            </a>
          </li>
          <li class="nav-item" id="users">
            <a href="users.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage User
              </p>
            </a>
          </li>
           <li class="nav-item" id="profile">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                My Profile
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
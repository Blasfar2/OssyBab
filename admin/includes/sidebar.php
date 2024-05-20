<div class="sidebar">
      <div class="logo-details">
        <div class="logo_name">OssyBad</div>
        <i class="bx bx-menu" id="btn"></i>
      </div>
      <ul class="nav-list">
        <li>
          <a href="../dashboard/">
          <i class='bx bxs-dashboard'></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <li>
          <a href="../categories/">
            <i class="bx bx-folder"></i>
            <span class="links_name">Categories</span>
          </a>
          <span class="tooltip">Categories</span>
        </li>
        <li>
          <a href="../products/">
          <i class='bx bxl-product-hunt' ></i>
            <span class="links_name">Products</span>
          </a>
          <span class="tooltip">Products</span>
        </li>
        <li>
          <a href="../customers/">
            <i class="bx bx-user"></i>
            <span class="links_name">Customers</span>
          </a>
          <span class="tooltip">Customers</span>
        </li>
        
        <!-- <li>
          <a href="#">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">Analytics</span>
          </a>
          <span class="tooltip">Analytics</span>
        </li> -->
       
        <li>
          <a href="../orders/">
            <i class="bx bx-cart-alt"></i>
            <span class="links_name">Orders</span>
          </a>
          <span class="tooltip">Orders</span>
        </li>
        <!-- <li>
          <a href="#">
            <i class="bx bx-heart"></i>
            <span class="links_name">Saved</span>
          </a>
          <span class="tooltip">Saved</span>
        </li> -->
        <li>
          <a href="../profile/">
            <i class="bx bx-cog"></i>
            <span class="links_name">Setting</span>
          </a>
          <span class="tooltip">Setting</span>
        </li>
        <li class="profile">
          <div class="profile-details">
            <div class="name_job">
              <div class="name"><?php echo $_SESSION['username']; ?></div>
              <div class="job">Admin Account</div>
            </div>
          </div>
          <i class="bx bx-log-out" id="log_out"></i>
        </li>
      </ul>
    </div>
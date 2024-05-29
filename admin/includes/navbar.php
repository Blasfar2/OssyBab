 <!-- NAVBAR -->
 <nav>
        <a href="#" class="nav-link">
          <i class="bx bxs-bell icon"></i>
          <span class="badge">5</span>
        </a>
        <span class="divider"></span>

        <!-- Profile dorpdown menu -->
        <div class="profile">
          <img
            src="<?php echo $_SESSION['UserImage']; ?>"
            alt=""
          />
          <ul class="profile-link">
            <li>
              <a href="../profile/"><i class="bx bxs-user-circle icon"></i> Profile</a>
            </li>
            <!-- <li>
              <a href="#"><i class="bx bxs-cog"></i> Settings</a>
            </li> -->
            <li>
              <a href="../logout.php"><i class="bx bxs-log-out-circle"></i> Logout</a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- NAVBAR -->
<header id="header" class="header fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="index.php" class="logo d-flex align-items-center">
      <img src="assets/img/.png" alt="">
    </a>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a style="text-decoration: none;" class="nav-link scrollto" href="index.php">Home</a></li>
        <li><a class="nav-link scrollto" href="product.php">Facilities</a></li>
        <?php
        if (isset($_SESSION['User'])) {
          echo '        
              <li class="dropdown"><a style="text-decoration: none;" class="nav-account"> 
              <span class="material-icons">
                account_circle
              </span>
              <span> ' . $_SESSION['User'] . '</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a style="text-decoration: none;" href="profile.php">Profile</a></li>
                  <li><a style="text-decoration: none;" href="inc/logout.php">Logout</a></li>
                  <li class="dropdown"><a style="text-decoration: none;" href="#"><span>Setting</span> <i class="bi bi-chevron-right"></i></a>
                  <ul>
                    <li><a style="text-decoration: none;" href="updateprofile.php">Update Profile</a></li>
                    <li><a style="text-decoration: none;" href="updatepassword.php">Change Password</a></li>
                  </ul>
                </li>
                </ul>
                
              </li>
              <li><a class="nav-account" style="text-decoration: none;" href="cart.php"><span class="material-icons">shopping_cart</span></a></li>
              ';
        } else if (isset($_SESSION['Admin'])){
          echo '        
          <li class="dropdown"><a style="text-decoration: none;" class="nav-account"> 
          <span class="material-icons">
            account_circle
          </span>
          <span> ' . $_SESSION['Admin'] . '</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a style="text-decoration: none;" href="admindashboard.php">Dashboard</a></li>
			  <li><a style="text-decoration: none;" href="postads.php">Add Facilities</a></li>
              <li><a style="text-decoration: none;" href="productadmin.php">Update Facilities</a></li>
              <li><a style="text-decoration: none;" href="signupadmin.php">Register New Staff</a></li
              <li><a style="text-decoration: none;" href="inc/logout.php">Logout</a></li>
            </ul>
          </li>';
        }else {
          echo '
            <li><a  style="text-decoration: none;" class="nav-account signup" href="login.php">Customer Login</a></li>
             <li><a  style="text-decoration: none;" class="nav-account signup" href="admin.php">Admin Login</a></li>
              <li><a  style="text-decoration: none;" class="nav-account signup" href="loginstaff.php">Staff Login</a></li>
            ';

        }
        ?>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->
<nav class="navbar navbar-expand-md bg-light navbar-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">FoodyFood</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>

        <!-- drop down for register restaurant or customer -->

        <?php if (!isset($_SESSION['loggedin'])) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Register
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="resreg.php">Restaurants</a>
              <a class="dropdown-item" href="cregister.php">Customer</a>

            </div>
          </li>
          <!-- drop down for login  -->

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Login
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="rlogin.php">Restaurants Login</a>
              <a class="dropdown-item" href="clogin.php">Customer Login</a>

            </div>
          </li>
        <?php

        } elseif (isset($_SESSION['reslogin'])) { ?>

          <li class="nav-item">
            <a class="nav-link" href="addmenu.php">Add Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="menulist.php">Menu List</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              <?php echo $_SESSION['name']
              ?>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="logout.php">logout</a>


            </div>
          </li>

        <?php
        } elseif (isset($_SESSION['clogin'])) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              <?php echo $_SESSION['name']
              ?>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="logout.php">logout</a>


            </div>
          </li>
        <?php } ?>

      </ul>
    </div>
  </div>
</nav>
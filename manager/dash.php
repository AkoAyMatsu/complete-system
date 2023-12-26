<?php
   require "handleDashAdmin.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <nav class="navbar bg-primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fs-5"></span>
            </button>
            <a class="navbar-brand text-light fs-5 me-auto fw-semibold d-sm-none d-md-flex company--name" href="#">BANI WATER REFILLING STATION</a>
            <!--Dropdown for user logout-->
                <div class="dropdown user--dropdown">
                    <button class="btn btn-outline-light user--button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="bi bi-person-circle fs-3 user--icon"></span>
                        <span class="px-2 fs-5 user--name">
                            <?php
                                echo $username;
                            ?>
                        </span>
                        <span class="dropdown dropdown-toggle fs-3 dropdown--icon"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end user--dropdown--list fs-5">
                        <li>
                            <a class="dropdown-item" href="profile.php">Profile
                                <span class="bi bi-person-circle fs-3 px-1"></span>
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>
                        <li class="">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal" href="#">Logout
                                <span class="bi bi-box-arrow-left fs-3 px-2"></span>
                            </a>
                        </li>
                    </ul>
                </div>

            <!--end of that dropdown-->

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header canvas--header">
                    <h5 class="offcanvas-title text-dark" id="offcanvasNavbarLabel">Welcome 
                        <span class="h5 --userWelcome">
                            <?php
                               echo $username . "!";
                            ?>
                        </span></h5>
                    <button type="button" class="btn-close close--btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-header canvas--header--2">
                    <div class="d-inline-flex align-items-center py-2 justify-content-center rounded-circle bg-primary --user">
                        <img src="<?php echo $user_image;?>" alt="User Images" class="rounded-circle" width="120px" height="112px">
                    </div>
                    <div class="h5 text-light me-auto px-3 mt-5 --userName" id="username">
                            <?php
                               echo $username;
                            ?>
                        <div class="h5 text-light pt-2">USER ID: <span class="h5 text-light --idNumber" id="id_number">
                            <?php
                                echo $userid;
                            ?>
                        </span></div>
                    </div>
                </div>

                <div class="offcanvas-body canvas--color">
                    <ul class="navbar-nav justify-content-end pe-3 nav--items">
                        <li class="nav-item">
                            <a class="nav-link active fs-5 text-light" aria-current="page" href="dash.php">
                                <span class="bi bi-speedometer fs-3 px-2"></span>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fs-5 text-light" href="orders.php">
                                <span class="bi bi-truck fs-3 px-2"></span>Deliveries/Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fs-5 text-light" href="inventory.php">
                                <span class="bi bi-box-fill fs-3 px-2"></span>Inventory
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fs-5 text-light" href="people.php">
                                <span class="bi bi-people-fill fs-3 px-2"></span>People
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fs-5 text-light" href="reports.php">
                                <span class="bi bi-clipboard-data-fill fs-3 px-2"></span>Reports
                            </a>
                        </li>
                        <!--Profile-->
                        <li class="nav-item">
                            <a class="nav-link active fs-5 text-light" href="profile.php">
                                <span class="bi bi-person-circle fs-3 px-2"></span>Profile
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="offcanvas-header canvas--footer">
                    <ul class="navbar-nav justify-content-end pe-3 logout--nav" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <li class="nav-item d-flex pt-1 py-1 logout--item">
                            <a class="nav-link active fs-5 text-light logout--text" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <span class="bi bi-box-arrow-left fs-2 px-2 logout--icon"></span>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<div class="container-fluid bg-primary-subtle h-100">
    <div class="container-fluid p-4 d-flex justify-content-center text-end">
        <!--Profile Card-->
            <div class="card m-3 text-center card--container" id="profileLink">
                <div class="bi bi-truck h1 p-2 text-center card--icon"></div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">ORDERS</h5>
                    <a href="orders.php" class="btn btn-primary btn-sm">
                        <span class="h5">Go to</span>
                        <span class="bi bi-arrow-down-square fs-4 px-1"></span>
                    </a>
                </div>
            </div>

            <div class="card m-3 text-center card--container" id="profileLink">
                <div class="bi bi-box-fill h1 p-2 text-center card--icon"></div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">INVENTORY</h5>
                    <a href="inventory.php" class="btn btn-primary btn-sm">
                        <span class="h5">Go to</span>
                        <span class="bi bi-arrow-down-square fs-4 px-1"></span>
                    </a>
                </div>
            </div>

            <div class="card m-3 text-center card--container" id="profileLink">
                <div class="bi bi-clipboard-fill h1 p-2 text-center card--icon"></div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">REPORTS</h5>
                    <a href="reports.php" class="btn btn-primary btn-sm">
                        <span class="h5">Go to</span>
                        <span class="bi bi-arrow-down-square fs-4 px-1"></span>
                    </a>
                </div>
            </div>

            <div class="card m-3 text-center card--container" id="profileLink">
                <div class="bi bi-people-fill h1 p-2 text-center card--icon"></div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">PEOPLE</h5>
                    <a href="people.php" class="btn btn-primary btn-sm">
                        <span class="h5">Go to</span>
                        <span class="bi bi-arrow-down-square fs-4 px-1"></span>
                    </a>
                </div>
            </div>

        <!--End-->
    </div>
    
</div>




<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Confirm logout</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to logout?
        </div>
        <div class="modal-footer">

          <a href="logout.php" class="text-light text-decoration-none btn btn-primary">Yes</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>
        
        
        
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>



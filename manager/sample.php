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
    <link rel="stylesheet" href="orders.css">
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
                            <?php echo $username; ?>
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
                    <h5 class="offcanvas-title text-dark" id="offcanvasNavbarLabel">Welcome <?php echo $username?>!</h5>
                    <button type="button" class="btn-close close--btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-header canvas--header--2">
                    <div class="d-inline-flex align-items-center py-2 justify-content-center rounded-circle bg-primary --user">
                        <img src="<?php echo $user_image;?>" alt="User Images" class="rounded-circle" width="120px" height="112px">
                    </div>
                    <div class="h5 text-light me-auto px-3 mt-5"><?php echo $username?>
                        <div class="h5 text-light pt-2">USER ID: <span class="id--number h5 text-light">
                            <?php echo $userid?>
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
                            <a class="nav-link active fs-5 text-light" href="#">
                                <span class="bi bi-people-fill fs-3 px-2"></span>People
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fs-5 text-light" href="#">
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




<section>
    <div class="container-fluid mb-5 mt-3">
            <ul class="nav nav-tabs row-cols-6">
                <li class="nav-item">
                    <a class="nav-link active bg-primary text-center text-light" data-bs-toggle="tab" href="#productContainer">Inventory</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link bg-danger text-center text-light" data-bs-toggle="tab" href="#boughtProducts">Products Bought</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link bg-danger text-center text-light" data-bs-toggle="tab" href="#borrowedProducts">Products Borrowed</a>
                </li>
                
                <!-- Add tabs for other categories as needed -->
            </ul>


            <div class="tab-content">
                <!--TO PAY TAB PANE-->
                <div id="productContainer" class="tab-pane active">
                        <table class="table table-responsive table-bordered border border-gray border-3 table-striped fs-5 dash--table">
                            <thead>
                                <tr class="text-center h6 table-info">
                                    <th scope="col" class="">Product Name</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Buy Unit Price</th>
                                    <th scope="col">Borrow Unit Price</th>
                                    <th scope="col">Refill Unit Price</th>
                                    <th scope="col">Product Quantity</th>

                                    <th scope="col">Product ID</th>
                                    <th scope="col">Update quantity</th>
                                    <!--<th scope="col">Product Bought</th>
                                    <th scope="col">Product Borrowed</th>
                                    <th scope="col">Product Refilled</th>-->
                                    
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="product-inventory-container">
                                <?php require "retrieveProducts.php"; ?>

                                <?php foreach ($products as $product): 
                                    
                                    $productName = $product['product_type'];
                                    $productImg = $product['product_img'];
                                    $buyPrice = $product['product_buy_price'];
                                    $refillPrice = $product['product_refill_price'];
                                    $borrowPrice = $product['product_borrow_price'];
                                    $productQuantity = $product['product_quantity'];
                                    $productId = $product['product_id']
                                    
                                ?>
                                <tr class="fw-bold h6 text-center">
                                    <td>
                                        <?php echo $productName; ?>
                                    </td>

                                    <td>
                                        <img src="../<?php echo $productImg?>" alt="" width=150 height=150 class="rounded-3"/>
                                    </td>

                                    <td>
                                        Php <?php echo $buyPrice ?>
                                    </td>

                                    <td>
                                        Php <?php echo $refillPrice ?>
                                    </td>

                                    <td>
                                        Php <?php echo $borrowPrice ?>
                                    </td>
                                    
                                    <td>
                                        <div class="mb-3">
                                            <label for="product--name" class="d-none col-form-label fw-bold">Product Name</label>
                                            <input type="text" class="form-control text-center" id="product--name" name="productNameInput" placeholder="e.g. (18L Rounded Gallon Water)" value="<?php echo $productQuantity ?>">
                                        </div>
                                        
                                    </td>

                                    <td>
                                        <?php echo $productId ?>
                                    </td>

                                    <td>
                                        <button class="btn btn-success">Update</button>
                                    </td>
                                </tr>
                                    
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="container-fluid d-flex justify-content-end">
                            <button class="btn btn-primary btn-lg fs-6" data-bs-toggle="modal" data-bs-target="#addProductsModal">Add products</button>
                        </div>
                </div>
                <!--END OF TO PAY TAB PANE-->

                <div id="boughtProducts" class="tab-pane active">
                        <table class="table table-responsive table-bordered border border-gray border-3 table-striped fs-5 dash--table">
                            <thead>
                                <tr class="text-center h6 table-info">
                                    <th scope="col" class="">Buyer's Name</th>
                                    <th scope="col">Products Bought</th>
                                    <th scope="col">Date of Purchase</th>
                                    <th scope="col">Quantity Bought</th>
                                    <th scope="col">Product ID</th>                                    
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="product-bought-container">

                            </tbody>
                        </table>
                 </div>

                <div id="borrowedProducts" class="tab-pane active">
                        <table class="table table-responsive table-bordered border border-gray border-3 table-striped fs-5 dash--table">
                            <thead>
                                <tr class="text-center h6 table-info">
                                    <th scope="col" class="">Borrower's Name</th>
                                    <th scope="col">Products Borrowed</th>
                                    <th scope="col">Borrow Date</th>
                                    <th scope="col">Quantity Borrowed</th>
                                    <th scope="col">Product ID</th>                                    
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="products-borrowed-container">

                            </tbody>
                        </table>
                </div>
                <!--END OF TO SHIP TAB PANE-->

            </div>
        </div>
</section>

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


        
        
        
        
    <script src="orders.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
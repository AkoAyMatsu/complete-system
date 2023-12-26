<?php 

    require "handleDashAdmin.php";
    require 'retrieveCustomerData.php';
    require 'retrieveEmployeeData.php';

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
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
    <link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  
    <link rel="stylesheet" href="reports.css">

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




<section>
    <div class="container-fluid mb-5 mt-3">
            <ul class="nav nav-tabs row-cols-6">
                <li class="nav-item">
                    <a class="nav-link active bg-primary text-center text-light" data-bs-toggle="tab" href="#salesReport">Sales
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link bg-success text-center text-light" data-bs-toggle="tab" href="#deliveryReport">Delivery</a>
                </li>


                <div class="ms-auto d-flex justify-content-end">
                    <button class="btn btn-warning bi bi-calendar3 fs-6" data-bs-toggle="modal" data-bs-target="#salesModal"></button>
                </div>

                <!--<div class="ms-auto d-flex">
                    <div class="">FROM</div>
                    <div class='input-group date mt-1' id='picker'>
                        <input type='text' class="form-control p-1"/>
                        <span class="input-group-addon" id="calendarIcon">
                            <span class="bi bi-calendar3 fs-1"></span>
                        </span>
                    </div>
                </div>-->

                

                
                <!-- Add tabs for other categories as needed -->
            </ul>

            <div class="tab-content">
                <!--TO PAY TAB PANE-->
                <div id="salesReport" class="tab-pane active">
                        <table class="table table-responsive table-bordered border border-gray border-3 table-striped fs-5 dash--table">
                            <thead>
                                <tr class="text-center h6 table-info">
                                    <th scope="col" class="">Product Sold</th>
                                    <th scope="col" class="">Date Completed</th>
                                    <th scope="col" class="">Order ID</th>
                                    <th scope="col" class="">Order Status</th>
                                    <th scope="col" class="">Type of Order</th>
                                    <th scope="col" class="">Payment Type</th>
                                    <th scope="col" class="">Total Amount</th>
                                    <th scope="col" class="">Quantity Sold</th>
                                    
                                    
                                    </tr>
                                    
                                   <!-- <th scope="col">Edit details</th>
                                    <th scope="col">Remove customer</th> -->
                                    <!--<th scope="col">Product Bought</th>
                                    <th scope="col">Product Borrowed</th>
                                    <th scope="col">Product Refilled</th>-->
                                    
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="sales-container">
                                <tr class="fw-bold fs-5 text-center">
                                    <td colspan=8>SALES REPORT GOES HERE</td>
                                </tr>
                            </tbody>
                            
                        </table>
                        <div class="text-end">
                            <button class="btn btn-info print-sale-report disabled">PRINT SALES REPORT</button>
                        </div>
                            

                        <div class="container-fluid d-flex justify-content-end">
                            <!--<button class="btn btn-primary btn-lg fs-6" data-bs-toggle="modal" data-bs-target="#saveReports">Save Reports</button>-->
                        </div>
                </div>
                <!--END OF TO PAY TAB PANE-->

                <div id="deliveryReport" class="tab-pane">
                        <table class="table table-responsive table-bordered border border-gray border-3 table-striped fs-5 dash--table">
                            <thead>
                                <tr class="text-center h6 table-info">
                                    <th scope="col" class="">Employee's Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Employee ID</th> 
                                    <th scope="col">User Role</th>
                                    <th scope="col">Edit Employee Details</th>
                                    <th scope="col">Delete Employee Data</th>
                                    <!--<th scope="col">Edit details</th>
                                    <th scope="col">Remove employee</th> -->                                  
                                </tr>
                            </thead>
                        <tbody class="table-group-divider" id="employee-container">
                            
                        </tbody>

                        </table>
                        <div class="container-fluid d-flex justify-content-end">
                            <!--<button class="btn btn-primary btn-lg fs-6" data-bs-toggle="modal" data-bs-target="#addemployee">Add employee</button>-->
                        </div>
                 </div>
                <!--END OF TO SHIP TAB PANE-->

            </div>
        </div>

        <div class="modal modal-md fade" id="salesModal" tabindex="-1" aria-labelledby="salesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="salesLabel">Choose a date</h1>
                        <button type="button" class="btn-close close-sales-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                    <div class="modal-body">
                        <div>
                            <select class="form-select" id="dateSelector">
                                <option value="Daily">Daily</option>
                                <option value="WeeklyMonthly">Weekly/Monthly</option>
                            </select>
                        </div>

                        <br/>
                        <!--DAILY-->
                        <form method="POST" id="daily-form" enctype="multipart/form-data">
                            <div class="form-group d-none" id="dailyGroup">
                                <div class='input-group date' id='daily_picker_1'>
                                    <span class="input-group-text">
                                        <span class="bi bi-calendar3 fs-5"></span>
                                    </span>
                                    <input type='text' placeholder="(e.g. 01/02/2024)" 
                                    class="form-control" id="daily_datepicker_1"
                                    name="daily-datepicker"/>
                                </div>
                            </div>
                        </form>

                        <!--WEEKLY -->
                        <form method="POST" enctype="multipart/form-data" id="weekly-monthly-form">
                            <div class="form-group d-none fw-bold" id="weeklyMonthlyGroup">
                                FROM
                                <div class='input-group date' id='weekly_monthly_picker_1'>
                                    <span class="input-group-text">
                                        <span class="bi bi-calendar3 fs-5"></span>
                                    </span>
                                    <input type='text' placeholder="(e.g. 12/26/2023)" 
                                    class="form-control" id="weekly_monthly_datepicker_1"
                                    name="wm-datepicker-1"/>
                                </div>

                                <br/>
                                TO
                                <div class='input-group date' id='weekly_monthly_picker_2'>
                                    <span class="input-group-text">
                                        <span class="bi bi-calendar3 fs-5"></span>
                                    </span>
                                    <input type='text' placeholder="(e.g. 01/02/2024)" 
                                    class="form-control" id="weekly_monthly_datepicker_2"
                                    name="wm-datepicker-2"/>
                                </div>

                            </div>
                        </form>


                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-auto close-sales-modal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-auto" id="dateOfSale" name="dateOfSale">Enter</button>
                        </div>
                   
                    </div>
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


    
    <script src="reports.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
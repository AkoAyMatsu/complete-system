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
    <link rel="stylesheet" href="people.css">
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
                    <a class="nav-link active bg-primary text-center text-light" data-bs-toggle="tab" href="#customerContainer">Customers</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link bg-success text-center text-light" data-bs-toggle="tab" href="#employeesContainer">Employees</a>
                </li>

                
                <!-- Add tabs for other categories as needed -->
            </ul>


            <div class="tab-content">
                <!--TO PAY TAB PANE-->
                <div id="customerContainer" class="tab-pane active">
                        <table class="table table-responsive table-bordered border border-gray border-3 table-striped fs-5 dash--table">
                            <thead>
                                <tr class="text-center h6 table-info">
                                    <th scope="col" class="">Customer's Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">User Role</th>
                                    <th scope="col">Edit Customer Details</th>
                                    <th scope="col">Delete Customer Data</th>
                                   <!-- <th scope="col">Edit details</th>
                                    <th scope="col">Remove customer</th> -->
                                    <!--<th scope="col">Product Bought</th>
                                    <th scope="col">Product Borrowed</th>
                                    <th scope="col">Product Refilled</th>-->
                                    
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="customer-container">
                                <?php 
                                    if(empty($customer_data)){
                                        echo '<tr class="text-center fs-5 fw-bold"><td colspan="8">NO CUSTOMER DATA FOUND!</td></tr>';
                                    }else{
                                        foreach ($customer_data as $customer): 
                                            $customer_name = $customer['firstname'] . ' ' . $customer['lastname'];
                                            $customer_address = $customer['address'];
                                            $customer_contact_number = $customer['con_number'];
                                            $customer_username = $customer['username'];
                                            $customer_id = $customer['user_id'];
                                            $customer_role = $customer['user_role'];
                                
                                ?>
                                    
                                    <tr class="text-center fs-6">
                                        <td><?php echo $customer_name;?></td>
                                        <td><?php echo $customer_address;?></td>
                                        <td><?php echo $customer_contact_number;?></td>
                                        <td><?php echo $customer_username;?></td>
                                        <td><?php echo $customer_id;?></td>
                                        <td><?php echo $customer_role;?></td>

                                        <td>
                                            <!-- Add a button for editing -->
                                            <button class="btn btn-primary edit-customer-button"
                                            data-customer-id="<?php echo $customer_id; ?>"
                                            data-customer-fname="<?php echo $customer['firstname'];?>"
                                            data-customer-lname="<?php echo $customer['lastname'];?>"
                                            data-customer-image = "<?php echo $customer['user_image'];?>"
                                            data-customer-address = "<?php echo $customer_address?>"
                                            data-customer-contact-number = "<?php echo $customer_contact_number?>"
                                            data-customer-username = "<?php echo $customer_username;?>"
                                            data-customer-password = "<?php echo $customer['password']?>"
                                            data-customer-image-path = "<?php echo $customer['user_image']?>"

                                            data-bs-toggle="modal"
                                            data-bs-target="#editcustomer">Edit</button>
                                            
                                        </td>

                                        <td>
                                            <!-- Add a button for deletion -->
                                            <button class="btn btn-danger delete-customer-button"
                                            data-customer-id="<?php echo $customer_id; ?>"
                                            data-customer-name="<?php echo $customer_name?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php 
                                
                                    endforeach;
                                    }
                                ?>

                            </tbody>
                        </table>

                        <div class="container-fluid d-flex justify-content-end">
                            <button class="btn btn-primary btn-lg fs-6" data-bs-toggle="modal" data-bs-target="#addcustomer">Add customer</button>
                        </div>
                </div>
                <!--END OF TO PAY TAB PANE-->

                <div id="employeesContainer" class="tab-pane">
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
                            <?php
                                if (empty($employee_data)) {
                                    echo '<tr class="text-center fs-5 fw-bold"><td colspan="8">NO EMPLOYEE DATA FOUND!</td></tr>';
                                } else {
                                    foreach ($employee_data as $employee):
                                        $employee_name = $employee['firstname'] . ' ' . $employee['lastname'];
                                        $employee_address = $employee['address'];
                                        $employee_contact_number = $employee['con_number'];
                                        $employee_username = $employee['username'];
                                        $employee_id = $employee['user_id'];
                                        $employee_role = $employee['user_role'];
                            ?>
                                    <tr class="text-center fs-6">
                                        <td><?php echo $employee_name; ?></td>
                                        <td><?php echo $employee_address; ?></td>
                                        <td><?php echo $employee_contact_number; ?></td>
                                        <td><?php echo $employee_username; ?></td>
                                        <td><?php echo $employee_id; ?></td>
                                        <td><?php echo $employee_role; ?></td>

                                        <td>
                                            <!-- Add a button for editing -->
                                            <button class="btn btn-primary edit-employee-button"
                                            data-employee-id="<?php echo $employee_id; ?>"
                                            data-employee-fname="<?php echo $employee['firstname'];?>"
                                            data-employee-lname="<?php echo $employee['lastname'];?>"
                                            data-employee-image = "<?php echo $employee['user_image'];?>"
                                            data-employee-address = "<?php echo $employee_address?>"
                                            data-employee-contact-number = "<?php echo $employee_contact_number?>"
                                            data-employee-username = "<?php echo $employee_username;?>"
                                            data-employee-password = "<?php echo $employee['password']?>"
                                            data-employee-image-path = "<?php echo $employee['user_image']?>"

                                            data-bs-toggle="modal"
                                            data-bs-target="#editemployee">Edit</button>
                                            <!-- Add a button for deletion -->
                                            
                                        </td>

                                        <td>
                                            <button class="btn btn-danger delete-employee-button"
                                                data-employee-id="<?php echo $employee_id; ?>"
                                                data-employee-name="<?php echo $employee_name?>">Delete</button>
                                        </td>

                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                        </tbody>

                        </table>
                        <div class="container-fluid d-flex justify-content-end">
                            <button class="btn btn-primary btn-lg fs-6" data-bs-toggle="modal" data-bs-target="#addemployee">Add employee</button>
                        </div>
                 </div>
                <!--END OF TO SHIP TAB PANE-->

            </div>
        </div>
</section>
<!--UPDATE CUSTOMER PROFILE-->
            <div class="modal modal-lg fade" id="editcustomer" tabindex="-1" aria-labelledby="editcustomerlabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="editcustomerlabel">Edit Customer Details</h1>
                        <button type="button" class="btn-close close-customer-edit-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                    <div class="modal-body">
                        <form id="customer-edit-form" method="POST" enctype="multipart/form-data">
                            <!--product name-->
                            <div class="mb-3">
                                <label for="edit-customer-fname" class="col-form-label fw-bold">First Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-customer-fname" name="edit-customer-firstname" placeholder="First name"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="edit-customer-lname" class="col-form-label fw-bold">Last Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-customer-lname" name="edit-customer-lastname" placeholder="Last name"
                                >
                            </div>

                            <input type="hidden" name="customer-id" id="customer-id">
                            <input type="hidden" name="customer-image-path" id="customer-image-path">
                            
                            <!--product image-->
                            <div class="mb-3">
                                    <div class="container-fluid px-5 text-center">
                                        <div class="p-1 d-inline-flex justify-content-center rounded-2 text-bg-light userImage">
                                            <img src="" alt="Profile image goes here..." class="rounded-2 img-fluid border border-0" id="editCustomerImageView" width="250" height="250">
                                        </div>

                                        <input type="file" id="edit-customer-file-upload" name="edit-customer-profile-image" class="d-none" accept="image/*">
                                        <label for="edit-customer-file-upload" class="edit-customer-upload-button btn btn-primary rounded-2 h6 mt-3 text-light border border-0 d-block w-50 m-auto">
                                            
                                            <span class="bi bi-upload fs-5 mx-2"></span>
                                            <span class="">Change profile image</span>
                                        </label>    
                                        
                                    </div>  
                                
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="edit-customer-home-address" class="col-form-label fw-bold">Address <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-customer-home-address" name="edit-customer-home-address">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="edit-customer-contact-number" class="col-form-label fw-bold">Contact Number <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-customer-contact-number" 
                                name="edit-customer-contact-number" placeholder="(e.g. 09999999999)" pattern="[0-9]+"
                                oninput="handleContactNumberInput(this)">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="edit-customer-username" class="col-form-label fw-bold">Username <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-customer-username" name="edit-customer-username">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="edit-customer-password" class="col-form-label fw-bold">Password <sup class="text-danger">*</sup></label>
                                <input type="password" class="form-control" id="edit-customer-password" name="edit-customer-password">
                                <span class="passwordToggle"></span>
                            </div>

                            
                         </form>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-auto close-customer-edit-modal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-auto" id="save-edit-customer" name="save-edit-customer-details">Update</button>
                        </div>
                   
                    </div>
                </div>
            </div>
<!--END OF EDIT MODAL-->

<!--UPDATE EMPLOYEE PROFILE-->
<div class="modal modal-lg fade" id="editemployee" tabindex="-1" aria-labelledby="editemployeelabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="editemployeelabel">Edit Employee Details</h1>
                        <button type="button" class="btn-close close-employee-edit-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                    <div class="modal-body">
                        <form id="employee-edit-form" method="POST" enctype="multipart/form-data">
                            <!--product name-->
                            <div class="mb-3">
                                <label for="edit-employee-fname" class="col-form-label fw-bold">First Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-employee-fname" name="edit-employee-firstname" placeholder="First name"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="edit-employee-lname" class="col-form-label fw-bold">Last Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-employee-lname" name="edit-employee-lastname" placeholder="Last name"
                                >
                            </div>

                            <input type="hidden" name="employee-id" id="employee-id">
                            <input type="hidden" name="employee-image-path" id="employee-image-path">
                            
                            <!--product image-->
                            <div class="mb-3">
                                    <div class="container-fluid px-5 text-center">
                                        <div class="p-1 d-inline-flex justify-content-center rounded-2 text-bg-light userImage">
                                            <img src="" alt="Profile image goes here..." class="rounded-2 img-fluid border border-0" id="editEmployeeImageView" width="250" height="250">
                                        </div>

                                        <input type="file" id="edit-employee-file-upload" name="edit-employee-profile-image" class="d-none" accept="image/*">
                                        <label for="edit-employee-file-upload" class="edit-employee-upload-button btn btn-primary rounded-2 h6 mt-3 text-light border border-0 d-block w-50 m-auto">
                                            
                                            <span class="bi bi-upload fs-5 mx-2"></span>
                                            <span class="">Change profile image</span>
                                        </label>    
                                        
                                    </div>  
                                
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="edit-employee-home-address" class="col-form-label fw-bold">Address <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-employee-home-address" name="edit-employee-home-address">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="edit-employee-contact-number" class="col-form-label fw-bold">Contact Number <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-employee-contact-number" 
                                name="edit-employee-contact-number" placeholder="(e.g. 09999999999)" pattern="[0-9]+"
                                oninput="handleContactNumberInput(this)">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="edit-employee-username" class="col-form-label fw-bold">Username <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="edit-employee-username" name="edit-employee-username">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="edit-employee-password" class="col-form-label fw-bold">Password <sup class="text-danger">*</sup></label>
                                <input type="password" class="form-control" id="edit-employee-password" name="edit-employee-password">
                                <span class="passwordToggle"></span>
                            </div>

                            
                         </form>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-auto close-employee-edit-modal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-auto" id="save-edit-employee" name="save-edit-employee-details">Update</button>
                        </div>
                   
                    </div>
                </div>
            </div>
<!--UPDATE EMPLOYEE PROFILE-->

<!--CUSTOMER MODAL-->

            <div class="modal modal-lg fade" id="addcustomer" tabindex="-1" aria-labelledby="addcustomerlabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="addcustomerlabel">Customer Details</h1>
                        <button type="button" class="btn-close close-customer-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                    <div class="modal-body">
                        <form id="customer-form" method="POST" enctype="multipart/form-data">
                            <!--product name-->
                            <div class="mb-3">
                                <label for="customer-fname" class="col-form-label fw-bold">First Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="customer-fname" name="customer-firstname" placeholder="First name"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="customer-lname" class="col-form-label fw-bold">Last Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="customer-lname" name="customer-lastname" placeholder="Last name"
                                >
                            </div>
                            
                            <!--product image-->
                            <div class="mb-3">
                                    <div class="container-fluid px-5 text-center">
                                        <div class="p-1 d-inline-flex justify-content-center rounded-2 text-bg-light userImage">
                                            <img src="" alt="Profile image goes here..." class="rounded-2 img-fluid border border-0" id="customerImageView" width="250" height="250">
                                        </div>

                                        <input type="file" id="customer-file-upload" name="customer-profile-image" class="d-none" accept="image/*">
                                        <label for="customer-file-upload" class="customer-upload-button btn btn-primary rounded-2 h6 mt-3 text-light border border-0 d-block w-50 m-auto">
                                            
                                            <span class="bi bi-upload fs-5 mx-2"></span>
                                            <span class="">Add profile image</span>
                                        </label>    
                                        
                                    </div>  
                                
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="customer-home-address" class="col-form-label fw-bold">Address <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="customer-home-address" name="customer-home-address">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="customer-contact-number" class="col-form-label fw-bold">Contact Number <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="customer-contact-number" 
                                name="customer-contact-number" placeholder="(e.g. 09999999999)" pattern="[0-9]+"
                                oninput="handleContactNumberInput(this)">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="customer-username" class="col-form-label fw-bold">Username <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="customer-username" name="customer-username">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="customer-password" class="col-form-label fw-bold">Password <sup class="text-danger">*</sup></label>
                                <input type="password" class="form-control" id="customer-password" name="customer-password">
                                <span class="passwordToggle"></span>
                            </div>

                            
                         </form>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-auto close-customer-modal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-auto" id="save-customer" name="save-customer-details">Save</button>
                        </div>
                   
                    </div>
                </div>
            </div>

<!--EMPLOYEE MODAL-->
        <div class="modal modal-lg fade" id="addemployee" tabindex="-1" aria-labelledby="addemployeelabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="addemployee">Employee Details</h1>
                        <button type="button" class="btn-close close-employee-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                    <div class="modal-body">
                        <form id="employee-form" method="POST" enctype="multipart/form-data">
                            <!--product name-->
                            <div class="mb-3">
                                <label for="employee-fname" class="col-form-label fw-bold">First Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="employee-fname" name="employee-firstname" placeholder="First name"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="employee-lname" class="col-form-label fw-bold">Last Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="employee-lname" name="employee-lastname" placeholder="Last name"
                                >
                            </div>
                            
                            <!--product image-->
                            <div class="mb-3">
                                    <div class="container-fluid px-5 text-center">
                                        <div class="p-1 d-inline-flex justify-content-center rounded-2 text-bg-light userImage">
                                            <img src="" alt="Profile image goes here..." class="rounded-2 img-fluid" id="employeeImageView" width="250" height="250">
                                        </div>

                                        <input type="file" id="employee-file-upload" name="employee-profile-image" class="d-none" accept="image/*">
                                        <label for="employee-file-upload" class="employee-upload-button btn btn-primary rounded-2 h6 mt-3 text-light border border-0 d-block w-50 m-auto">
                                            <span class="bi bi-upload fs-5 mx-2"></span>
                                            <span class="">Add profile image</span>
                                        </label>    
                                        
                                    </div>  
                                
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="employee-home-address" class="col-form-label fw-bold">Address <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="employee-home-address" name="employee-home-address">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="employee-contact-number" class="col-form-label fw-bold">Contact Number <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="employee-contact-number" name="employee-contact-number" 
                                placeholder="(e.g. 09999999999)" oninput="handleContactNumberInput(this)">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="employee-username" class="col-form-label fw-bold">Username <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="employee-username" name="employee-username" value="">
                            </div>

                            <!--product image-->
                            <div class="mb-3">
                                <label for="employee-password" class="col-form-label fw-bold">Password <sup class="text-danger">*</sup></label>
                                <input type="password" class="form-control" id="employee-password" name="employee-password" value="">
                                <span class="passwordToggle"></span>
                            </div>

                        </form>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-auto close-employee-modal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ms-auto" id="save-employee" name="save-employee-details">Save</button>
                        </div>
                   
                    </div>
                </div>
            </div>
<!--CUSTOMER MODAL-->

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


    
    <script src="people.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
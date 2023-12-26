<?php
// Function to display notification
//php file to handle the server side
// server-side renderings
function displayNotification($message, $type)
{
    $notificationClass = ($type === 'success') ? 'success' : 'error';
    echo '<div class="notification ' . $notificationClass . '">' . $message . '</div>';
}

// Check if the form is submitted
if (isset($_POST['SignUpButton'])) {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contactNumber = $_POST['con_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $userImage = $_FILES['profileImg'];

    
    if (empty($firstname) || empty($lastname) || empty($address) || empty($contactNumber) ||
        empty($username) || empty($password) || empty($userImage['name'])) {
        displayNotification("Please fill in all fields!", "error");
        clearFormFields();
    } elseif (strlen($contactNumber) !== 11) {
        displayNotification("Contact number should be 11 digits long!", "error");
        clearFormFields();
    } elseif (!ctype_digit($contactNumber)) {
        displayNotification("Numeric characters only!", "error");
    } elseif (strlen($password) < 8 || strlen($password) > 20) {
        displayNotification("Password should be 8-20 characters long!", "error");
        clearFormFields();
    } else if (!isset($_POST['userRole'])){
        displayNotification("Please select user role!", "error");
        clearFormFields();
    }else {
        // Database connection
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $database = "bwrs";

        // Validate form fields
        $userRole = $_POST["userRole"];
        //echo "Selected option: " . $userRole;

        try {
            $conn = new mysqli($servername, $dbUsername, $dbPassword, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare the SQL statement based on the user role
            if ($userRole === "Customer") {
                $tableName = "customer";
                $idPrefix = "201";
            } elseif ($userRole === "Employee") {
                $tableName = "employee";    
                $idPrefix = "202";
            }

            
            $usernameQuery = "SELECT * FROM $tableName WHERE username = '$username'";
            $usernameResult = $conn->query($usernameQuery);

             $phoneNumberQuery = "SELECT * FROM $tableName WHERE con_number = '$contactNumber'";
             $phoneNumberResult = $conn -> query($phoneNumberQuery);

            // Check if the username and phoneNumber is already taken
            if($usernameResult->num_rows > 0 && $phoneNumberResult->num_rows > 0){
                displayNotification("Username and contact number is already taken!", 'error');
                clearFormFields();
            }
            //check if only the username is taken
            else if ($usernameResult->num_rows > 0) {
                displayNotification("Username is already taken!", "error");         
                clearFormFields();
            }
            //check if only the phone number is taken
            else if($phoneNumberResult-> num_rows > 0){
                displayNotification("Contact number is already taken!", "error");
                clearFormFields();
            }


            // Generate the ID
            $id = generateId($conn, $tableName, $idPrefix);

            // Check if a file was uploaded successfully
            if ($userImage['error'] === UPLOAD_ERR_OK) {
                $tmpName = $userImage['tmp_name'];

                // Choose a directory to store the uploaded image
                $uploadDirectory = "sample_images/"; // Replace with the actual directory path

                $imageIdPrefix = "CUSTOMER201_";
                $receiveUserImageId = generateUserImageId($imageIdPrefix);

                // Generate a unique file name for the uploaded image
                $fileName = $receiveUserImageId . '_' . $userImage['name'];

                // Move the uploaded file to the desired directory
                $destination = $uploadDirectory . $fileName;
                if (move_uploaded_file($tmpName, $destination)) {
                    // File upload was successful, now you can store the file path or name in the database
                    // Modify your SQL statement to include the file path or name

                    // Insert user data into the appropriate table
                    $sql = "INSERT INTO $tableName (user_id, firstname, lastname, address, con_number, username, password, user_image, user_role) 
                            VALUES ('$id', '$firstname', '$lastname', '$address', '$contactNumber', '$username', '$password', '$destination', '$userRole')";

                    if ($conn->query($sql) === true) {
                        displayNotification("Account registered successfully!", "success");
                        
                        clearFormFields();
                        
                    } else {
                        throw new Exception("Error: " . $sql . "<br>" . $conn->error);
                    }
                    $conn->close();

                    // Rest of your code...
                } else {
                    displayNotification("Error moving the uploaded file to the destination directory!", "error");
                }
            } else {
                displayNotification("Error uploading the file. Please try again!", "error");
            }
        } catch (Exception $e) {
            displayNotification("Error: " . $e->getMessage(), "error");
        }
    }
}

// Function to generate the ID based on the prefix and random last three numbers
function generateId($conn, $tableName, $idPrefix)
{
    $randomNumber = str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
    $newId = $idPrefix . $randomNumber;

    // Check if the generated ID already exists in the table
    $sql = "SELECT user_id FROM $tableName WHERE user_id = '$newId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // If the ID already exists, generate a new one recursively
        $newId = generateId($conn, $tableName, $idPrefix);
    }

    return $newId;
}

function generateUserImageId($prefix){
    $randomIdNumber =  str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);

    $newId = $prefix . $randomIdNumber;

    return $newId;
}
function clearFormFields(){
    // Clear input fields
    $_POST['firstname'] = '';
    $_POST['lastname'] = '';
    $_POST['address'] = '';
    $_POST['con_number'] = '';
    $_POST['username'] = '';
    $_POST['password'] = '';

    // Reset user role selection
    $_POST['user_role'] = 'Default';
}
?>
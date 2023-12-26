<?php
// Start or resume a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, return an error response
    $response = array('success' => false, 'message' => 'User not logged in.');

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Stop further execution
}

// Continue with the rest of the code if the user is logged in

// Replace these variables with your actual database credentials
$servername = "localhost";
$server_username = "root";
$server_password = "";
$dbname = "bwrs";

// Create a connection to the database
$conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize response array
$response = array('success' => false, 'message' => '');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and sanitize user inputs
    function sanitizeInput($input)
    {
        global $conn;
        return $conn->real_escape_string($input);
    }

    // Function to check if a username or contact number already exists in the database
    function isDuplicate($column, $value, $id)
    {
        global $conn;
        $result = $conn->query("SELECT * FROM employee WHERE $column = '$value' AND user_id != '$id' LIMIT 1");
        return $result->num_rows > 0;
    }

    // Function to validate contact number format
    function isValidContactNumber($contact_number)
    {
        return preg_match("/^[0-9]{11}$/", $contact_number);
    }

    // Function to validate username length
    function isValidUsernameLength($username)
    {
        $length = strlen($username);
        return ($length >= 8 && $length <= 30);
    }

    // Function to check if the uploaded image is of a valid type
    function isValidImageType($file_type)
    {
        $valid_types = array('image/jpeg', 'image/png', 'image/gif');
        return in_array($file_type, $valid_types);
    }

    // Handle the uploaded image
    $target_dir = "../../bwrs/sample_images/EMPLOYEE_"; // Replace with your desired directory
    $default_image_path = "../../bwrs/sample_images/user-icon.png"; // Replace with the path to your default image


    $image_path = '';

    if (!empty($_FILES["edit-employee-profile-image"]["name"])) {
        $target_file = $target_dir . basename($_FILES["edit-employee-profile-image"]["name"]);

        $file_type = $_FILES["edit-employee-profile-image"]["type"];

        // Check if the image type is valid
        if (!isValidImageType($file_type)) {
            $response['message'] = 'Invalid image type. Please upload a valid image (JPEG, PNG, GIF).';
            // Return the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit(); // Stop further execution
        }

        if (move_uploaded_file($_FILES["edit-employee-profile-image"]["tmp_name"], $target_file)) {
            // File uploaded successfully
            $image_path = $target_file;
        } else {
            // Handle file upload error
            $image_path = $default_image_path;
        }
    } elseif (!empty($_POST['employee-image-path'])) {
        // No new image uploaded, use the path from the form
        $image_path = sanitizeInput($_POST['employee-image-path']);
    } else {
        // No image uploaded, use default image
        $image_path = $default_image_path;
    }

    // Escape and sanitize user inputs
    $firstname = sanitizeInput($_POST['edit-employee-firstname']);
    $lastname = sanitizeInput($_POST['edit-employee-lastname']);
    $address = sanitizeInput($_POST['edit-employee-home-address']);
    $contact_number = sanitizeInput($_POST['edit-employee-contact-number']);
    $username = sanitizeInput($_POST['edit-employee-username']);
    $password = $_POST['edit-employee-password']; // Hash the password for security

    $employee_role = "Employee";

    $employee_id = sanitizeInput($_POST['employee-id']);

    // Check if any field is empty
    if (empty($firstname) || empty($lastname) || empty($address) || empty($contact_number) || empty($username) || empty($_POST['edit-employee-password'])) {
        $response['message'] = 'All fields are required.';
    } elseif (!isValidUsernameLength($username)) {
        // Check if username length is within the allowed range
        $response['message'] = 'Username must be between 8 and 20 characters.';
    } elseif (!is_numeric($contact_number) || !isValidContactNumber($contact_number)) {
        // Check if contact number is numeric and has a valid length
        $response['message'] = 'Invalid contact number format.';
    } elseif (isDuplicate('username', $username, $employee_id)) {
        // Check if the username already exists in the database
        $response['message'] = 'Username already exists.';
    } elseif (isDuplicate('con_number', $contact_number, $employee_id)) {
        // Check if the contact number already exists in the database
        $response['message'] = 'Contact number already exists.';
    } else {
        // Check if the data has been edited
        if (!empty($_FILES["edit-employee-profile-image"]["name"])) {
            // New image uploaded, include user_image in the comparison
            $sql_check_edited = "SELECT * FROM employee WHERE user_id = '$employee_id' AND
                                (firstname != '$firstname' OR lastname != '$lastname' OR address != '$address' OR
                                con_number != '$contact_number' OR username != '$username' OR password != '$password' OR
                                user_image != '$image_path')";
        } else {
            // No new image uploaded, exclude user_image from the comparison
            $sql_check_edited = "SELECT * FROM employee WHERE user_id = '$employee_id' AND
                                (firstname != '$firstname' OR lastname != '$lastname' OR address != '$address' OR
                                con_number != '$contact_number' OR username != '$username' OR password != '$password')";
        }

        $result_check_edited = $conn->query($sql_check_edited);

        if ($result_check_edited === FALSE) {
            // Handle the SQL query error
            $response['message'] = 'Error checking if data is edited: ' . $conn->error;
        } elseif ($result_check_edited->num_rows > 0) {
            // Data has been edited, proceed with the update
            $sql_update = "UPDATE employee
                        SET firstname='$firstname', lastname='$lastname', address='$address', 
                        con_number='$contact_number', username='$username', password='$password', 
                        user_image='$image_path', user_role='$employee_role'
                        WHERE user_id='$employee_id'";

            if ($conn->query($sql_update) === TRUE) {
                // Data updated successfully
                $response['success'] = true;
                $response['message'] = 'Employee data updated successfully!';
            } else {
                // Handle the SQL query error
                $response['message'] = 'Error updating employee data: ' . $conn->error;
            }
        } else {
            // No data edited
            $response['message'] = 'No edited data.';
        }

    }
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
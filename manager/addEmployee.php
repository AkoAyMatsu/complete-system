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
    function isDuplicate($column, $value)
    {
        global $conn;
        $result = $conn->query("SELECT * FROM employee WHERE $column = '$value' LIMIT 1");
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

    // Function to generate a random user ID
    function generateRandomUserId() {
        return '301' . str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
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

    if (!empty($_FILES["employee-profile-image"]["name"])) {
        $target_file = $target_dir . basename($_FILES["employee-profile-image"]["name"]);

        $file_type = $_FILES["employee-profile-image"]["type"];

        // Check if the image type is valid
        if (!isValidImageType($file_type)) {
            $response['message'] = 'Invalid image type. Please upload a valid image (JPEG, PNG, GIF).';
            // Return the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit(); // Stop further execution
        }

        if (move_uploaded_file($_FILES["employee-profile-image"]["tmp_name"], $target_file)) {
            // File uploaded successfully
            $image_path = $target_file;
        } else {
            // Handle file upload error
            $image_path = $default_image_path;
        }
    } else {
        // No image uploaded, use default image
        $image_path = $default_image_path;

        // Check if the file type information is missing
        /*if (!isset($_FILES["customer-profile-image"]["type"])) {
            $response['message'] = 'Image type information is missing.';
            // Return the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit(); // Stop further execution
        }

        // Check if the image type is valid
        $file_type = $_FILES["customer-profile-image"]["type"];
        if (!isValidImageType($file_type)) {
            $response['message'] = 'Invalid image type. Please upload a valid image (JPEG, PNG, GIF).';
            // Return the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit(); // Stop further execution
        }*/
    }

    // Escape and sanitize user inputs
    $firstname = sanitizeInput($_POST['employee-firstname']);
    $lastname = sanitizeInput($_POST['employee-lastname']);
    $address = sanitizeInput($_POST['employee-home-address']);
    $contact_number = sanitizeInput($_POST['employee-contact-number']);
    $username = sanitizeInput($_POST['employee-username']);
    $password = $_POST['employee-password'];// Hash the password for security

    $employee_role = "Employee";

    $employee_id = generateRandomUserId();

    // Check if any field is empty
    if (empty($firstname) || empty($lastname) || empty($address) || empty($contact_number) || empty($username) || empty($password)) {
        $response['message'] = 'All fields are required.';
    } elseif (!isValidUsernameLength($username)) {
        // Check if username length is within the allowed range
        $response['message'] = 'Username must be between 8 and 20 characters.';
    } elseif (!is_numeric($contact_number) || !isValidContactNumber($contact_number)) {
        // Check if contact number is numeric and has a valid length
        $response['message'] = 'Invalid contact number format.';
    } elseif (isDuplicate('username', $username)) {
        // Check if the username already exists in the database
        $response['message'] = 'Username already exists.';
    } elseif (isDuplicate('con_number', $contact_number)) {
        // Check if the contact number already exists in the database
        $response['message'] = 'Contact number already exists.';
    } else {
        // SQL query to insert data into the database
        $sql = "INSERT INTO employee (firstname, lastname, address, con_number, username, password, user_image, user_id, user_role)
                VALUES ('$firstname', '$lastname', '$address', '$contact_number', '$username', '$password', '$image_path', '$employee_id', '$employee_role')";

        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully
            $response['success'] = true;
            $response['message'] = 'Employee data saved successfully!';
        } else {
            // Handle the SQL query error
            $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

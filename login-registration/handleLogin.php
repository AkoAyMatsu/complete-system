<?php
session_start();
// Database credentials
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bwrs";

// Establish database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to display notification
function displayNotification($message, $type) {
    $notificationClass = ($type === 'success') ? 'success' : 'error';
    echo '<div class="notification ' . $notificationClass . '">' . $message . '</div>';
}

function sanitizeInput($input) {
    // Sanitize the input using appropriate methods (e.g., mysqli_real_escape_string)
    global $conn;
    return mysqli_real_escape_string($conn, $input);
}

function usernameExists($username, $table) {
    global $conn;
    $username = sanitizeInput($username);

    $stmt = $conn->prepare("SELECT user_id FROM $table WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}

function verifyLogin($username, $password, $table) {
    global $conn;
    $username = sanitizeInput($username);

    if (!usernameExists($username, $table)) {
        return false; // Username does not exist
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM $table WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        return true; // Login successful for customer and employees
    } else {
        return false; // Login failed for customers and employees
    }
}

if (isset($_POST['LoginButton'])) {
    $username = $_POST['userName'];
    $password = $_POST['passWord'];

    if (verifyLogin($username, $password, 'customer')) {
        displayNotification($username . " login success!", "success");
        header("Location: customer_page/dash.php");
        clearFormFields();
        exit();
        // Redirect to customer dashboard or desired page
    } elseif (verifyLogin($username, $password, 'employee')) {
        displayNotification("Employee login success!", "success");
        //header("Location: employee_page/dash.php");
        clearFormFields();
        exit();
        // Redirect to employee dashboard or desired page
    } elseif (verifyLogin($username, $password, 'admin')) {
        displayNotification("Welcome " . $username, "success");
        header("Location: manager_page/dash.php");
        clearFormFields();
        exit();
        // Redirect to admin dashboard or desired page
    } else {
        displayNotification("Login failed. Please check your username and password.", "error");
        clearFormFields();
    }
}

function clearFormFields() {
    // Clear input fields
    $_POST['userName'] = '';
    $_POST['passWord'] = '';
}

$conn->close();
?>

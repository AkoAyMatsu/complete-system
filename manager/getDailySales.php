<?php

// Start the session
session_start();

// Check if the user is logged in (adjust 'user_id' to your actual session variable)
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle unauthorized access as needed
    header("Location: ../login.php"); // Redirect to login page, for example
    exit();
}

// Replace these values with your actual database connection details
$servername = "localhost";
$server_username = "root";
$server_password = "";
$dbname = "bwrs";

// Create connection
$conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize response arrays
$successResponse = array();
$errorResponse = array();
$successData = array();
$noSalesResults = array();

// Get the date parameter and check if it is empty
$date_of_sale = $_POST['daily-datepicker'];

// Validate the date format first
if (!isValidDateFormat($date_of_sale)) {
    $errorResponse['message'] = "Empty date or not a proper date format!";
} else {
    // Sanitize the input to prevent SQL injection (you should use prepared statements for better security)
    $date_of_sale = mysqli_real_escape_string($conn, $date_of_sale);

    // SQL query to retrieve data based on the given date, joining customer_order and products tables
    $sql = "SELECT co.*, p.*, pa.*
            FROM customer_order co
            JOIN products p ON co.product_id = p.product_id
            JOIN payment pa ON co.payment_id = pa.payment_id
            WHERE co.order_date = '$date_of_sale' AND co.order_status = 'Completed'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $successData[] = array(
                'order_id' => $row["order_id"],
                'order_date' => $row["order_date"],
                'product_name' => $row["product_type"],
                'product_id' => $row["product_id"],
                'order_status' => $row['order_status'],
                'total_price' => $row['total_price'],
                'order_quantity' => $row['order_quantity'],
                'sale_date' => $row['completion_date'],
                'order_type' => $row['order_type'],
                'payment_method' => $row['payment_type']
                // Add more fields as needed
            );
        }

        // Add a general success message to the success response array
        $successResponse['message'] = "Successfully retrieved order data.";
    } else {
        $noSalesResults['noresults'] = "No results found for the given date!";
    }
}

// Combine success and error responses
$response = array(
    'success' => $successResponse,
    'error' => $errorResponse,
    'success_data' => $successData,
    'noResults' => $noSalesResults
);

// Return the response in JSON format
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();

// Function to validate date format
function isValidDateFormat($date)
{
    $format = 'm/d/Y';
    $dateTimeObj = DateTime::createFromFormat($format, $date);
    return $dateTimeObj && $dateTimeObj->format($format) === $date;
}

?>

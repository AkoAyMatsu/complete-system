<?php

session_start();
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password
$dbname = "bwrs"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

$orders = [];

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace 'customer_order', 'products', and 'customer_table' with your actual table names
define("TABLE_CUSTOMER_ORDER", "customer_order");
define("TABLE_PRODUCTS", "products");
define("TABLE_CUSTOMER", "customer");

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Retrieve all orders with status 'Completed' and order type 'Buy' including customer information
    $getOrdersQuery = "SELECT co.*, p.*, ct.*
                        FROM " . TABLE_CUSTOMER_ORDER . " co
                        JOIN " . TABLE_PRODUCTS . " p ON co.product_id = p.product_id
                        JOIN " . TABLE_CUSTOMER . " ct ON co.user_id = ct.user_id
                        WHERE co.order_status = 'Completed' AND co.order_type = 'Buy'";
    $result = $conn->query($getOrdersQuery);

    if ($result === false) {
        // Output error message along with the SQL query
        echo json_encode(['success' => false, 'message' => 'Error in getOrdersQuery: ' . $conn->error]);
    } else {
        // Organize the orders into an associative array
        while ($row = $result->fetch_assoc()) {
            $customerId = $row['user_id'];
            $customerData = [
                'order_id' => $row['order_id'],
                'product_id' => $row['product_id'],
                'product_name' => $row['product_type'],
                'user_id' => $row['user_id'],
                'product_image' => $row['product_img'],
                'customer_name' => $row['firstname'] . ' ' . $row['lastname'],
                'order_status' => $row['order_status'],
                'order_date' => $row['order_date'],
                'order_quantity' => $row['order_quantity'],
                'order_type' => $row['order_type']
                // Add other fields as needed
            ];

            // Append the order data to the corresponding customer ID key
            if (!isset($orders[$customerId])) {
                $orders[$customerId] = [];
            }
            $orders[$customerId][] = $customerData;
        }

        // Return the orders as JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Orders successfully retrieved!', 'orders' => $orders]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
}

// Close the database connection
$conn->close();

?>

<?php
session_start();

// Check if data was sent in the request body
$dataJSON = file_get_contents("php://input");

if ($dataJSON !== false) {
    // Decode the JSON data
    $data = json_decode($dataJSON, true);

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Get user_id from the session
        $user_id = $_SESSION['user_id'];

        // Replace these with your actual database connection details
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "bwrs";

        $customer_order_table = "customer_order";
        $product_table = "products"; // Corrected table name

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $order_status = "Cancelled";

        // Extract the cancelled order_ids from the JSON data
        $cancelledOrderIds = array_map('intval', array_column($data['cancelled_items'], 'order_id'));

        // Ensure that the array of cancelled order IDs is not empty
        if (!empty($cancelledOrderIds)) {
            // Select cancelled items with product data for a specific user and order_ids
            $sql = "SELECT customer_order.*, $product_table.* 
                    FROM $customer_order_table 
                    JOIN $product_table ON customer_order.product_id = $product_table.product_id
                    WHERE customer_order.order_status = '$order_status' 
                    AND customer_order.user_id = '$user_id'
                    AND customer_order.order_id IN (" . implode(",", $cancelledOrderIds) . ")
                    ORDER BY customer_order.order_date DESC";

            $result = $conn->query($sql);

            // Initialize an array to store the results
            $cancelledItems = [];

            // Check if there are results
            if ($result->num_rows > 0) {
                // Fetch and store the cancelled items in the array
                while ($row = $result->fetch_assoc()) {
                    // Add each row to the results array
                    $cancelledItems[] = $row;
                }
            }

            // Close the database connection
            $conn->close();

            // Output the array as JSON (you can modify this part based on your needs)
            header('Content-Type: application/json');
            echo json_encode($cancelledItems, JSON_PRETTY_PRINT);
        } else {
            // Handle the case when the array of cancelled order IDs is empty
            header('Content-Type: application/json');
            echo json_encode(["error" => "No cancelled order IDs provided"], JSON_PRETTY_PRINT);
        }
    } else {
        // Handle the case when the user is not logged in
        header('Content-Type: application/json');
        echo json_encode(["error" => "User not logged in"], JSON_PRETTY_PRINT);
    }
} else {
    // Handle the case when no data is provided in the request body
    header('Content-Type: application/json');
    echo json_encode(["error" => "No data provided in the request body"], JSON_PRETTY_PRINT);
}
?>

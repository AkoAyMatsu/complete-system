<?php
    session_start();

    // Check if user_id is set in the session
    if (!isset($_SESSION['user_id'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'user_id not set in the session'], JSON_PRETTY_PRINT);
        exit;
    }

    // Replace these with your actual database connection details
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "bwrs";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Fetch data from multiple tables using a single query with JOIN operations
    $query = "SELECT 
            co.*, 
            c.*, 
            ch.*, 
            p.*,
            pr.*  -- Include the products table
        FROM 
            customer_order co
        LEFT JOIN 
            customer c ON c.user_id = co.user_id
        LEFT JOIN 
            checkout_order cho ON co.order_id = cho.order_id
        LEFT JOIN 
            payment p ON co.payment_id = p.payment_id
        LEFT JOIN
            checkout ch ON cho.checkout_id = ch.checkout_id
        LEFT JOIN
            products pr ON co.product_id = pr.product_id  -- Join with the products table
        WHERE 
            co.user_id = $user_id
            AND (co.order_status = 'In transit' OR co.order_status = 'To receive' OR co.order_status = 'Completed')
    ";

    $result = $conn->query($query);

    $receiveOrderData = $result->fetch_all(MYSQLI_ASSOC);

    // Close the database connection
    $conn->close();

    // Output the data as JSON (you can modify this part based on your needs)
    header('Content-Type: application/json');
    echo json_encode(['receiveOrderData' => $receiveOrderData], JSON_PRETTY_PRINT);
?>

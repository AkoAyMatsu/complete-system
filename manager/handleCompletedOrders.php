<?php
    session_start();

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

    // Fetch all user IDs from the customer table
    $userIdsQuery = "SELECT DISTINCT user_id FROM customer";
    $userIdsResult = $conn->query($userIdsQuery);

    // Initialize an array to store all user data
    $allUserData = [];

    // Loop through each user
    while ($userIdRow = $userIdsResult->fetch_assoc()) {
        $user_id = $userIdRow['user_id'];

        // Fetch data from multiple tables using a single query with JOIN operations for each user
        $query = "SELECT 
                co.*, 
                c.*, 
                ch.*, 
                p.*,
                pr.*,
                cho.*  -- Add the columns you need from the checkout_order table
            FROM 
                checkout_order cho
            LEFT JOIN 
                customer_order co ON co.order_id = cho.order_id
            LEFT JOIN 
                customer c ON c.user_id = co.user_id
            LEFT JOIN 
                payment p ON cho.payment_id = p.payment_id
            LEFT JOIN
                checkout ch ON cho.checkout_id = ch.checkout_id
            LEFT JOIN
                products pr ON co.product_id = pr.product_id
            WHERE 
                co.user_id = $user_id
                AND co.order_status = 'Completed'
    
        ";

        $result = $conn->query($query);

        // Add the user data to the array
        $allUserData[$user_id] = $result->fetch_all(MYSQLI_ASSOC);
    }

    // Close the database connection
    $conn->close();

    // Output the data as JSON with the key "allUserData"
    header('Content-Type: application/json');
    echo json_encode(['allUserData' => $allUserData], JSON_PRETTY_PRINT);
?>

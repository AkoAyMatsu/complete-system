<?php

    //session_start();
    // Assuming you have a database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming no password
    $dbname = "bwrs"; // Replace with your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    $products = [];

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Replace 'products' with your actual products table name
    define("TABLE_PRODUCTS", "products");

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Retrieve all product data for the specific user from the products table
        $getProductsQuery = "SELECT * FROM " . TABLE_PRODUCTS . " ";
        $result = $conn->query($getProductsQuery);

        if ($result === false) {
            // Output error message along with the SQL query
            echo "Error in getProductsQuery: " . $conn->error . "\n";
            echo "Query: $getProductsQuery\n";
        } else {

            // Fetch product data
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }

            // Return the products as JSON
            //header('Content-Type: application/json');
            //echo json_encode(['success' => true, 'message' => 'Products successfully retrieved!', 'products' => $products]);
        }
    } else {
        //echo json_encode(['success' => false, 'message' => 'User not authenticated']);

        echo "User not logged in!";
    }

    // Close the database connection
    $conn->close();

?>

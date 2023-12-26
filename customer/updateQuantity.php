<?php
    // Start session (this should be at the top of your script)
    session_start();

    // Assuming your database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bwrs";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    $updatedQuantities = array(); 

    // Check if user is logged in
    if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
        if ($data && is_array($data)) {
            // Array to store updated quantities
            foreach ($data as $order) {
                if (isset($order['order_type'])) {
                    $productId = $order['product_id'];
                    $orderQuantity = $order['order_quantity'];

                    // Fetch current product quantity and type from the database
                    $selectSql = "SELECT product_id, product_quantity, product_type FROM products WHERE product_id = $productId";
                    $result = $conn->query($selectSql);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $currentQuantity = $row['product_quantity'];
                        $productType = $row['product_type'];

                        // Update product quantity based on order type
                        if ($order['order_type'] === 'Buy' || $order['order_type'] === 'Borrow') {
                            $newQuantity = $currentQuantity - $orderQuantity;
                        } elseif ($order['order_type'] === 'Refill') {
                            // For 'Refill' orders, do not decrease the product quantity
                            $newQuantity = $currentQuantity;
                        }

                        // Update the database with the new quantity
                        $updateSql = "UPDATE products SET product_quantity = $newQuantity WHERE product_id = $productId";
                        if ($conn->query($updateSql) !== TRUE) {
                            echo json_encode(array('success' => false, 'message' => 'Error updating quantity: ' . $conn->error));
                            $conn->close();
                            exit;
                        }

                        // Fetch the updated product quantity
                        $updatedQuantitySql = "SELECT product_quantity FROM products WHERE product_id = $productId";
                        $updatedQuantityResult = $conn->query($updatedQuantitySql);

                        if ($updatedQuantityResult && $updatedQuantityResult->num_rows > 0) {
                            $updatedQuantityRow = $updatedQuantityResult->fetch_assoc();
                            $updatedQuantity = $updatedQuantityRow['product_quantity'];

                            // Store the updated quantity in the array
                            $updatedQuantities[] = array(
                                'product_id' => $productId,
                                'product_type' => $productType,
                                'updated_quantity' => $updatedQuantity
                            );
                        } else {
                            echo json_encode(array('success' => false, 'message' => 'Error fetching updated quantity: ' . $conn->error));
                        }
                    } else {
                        echo json_encode(array('success' => false, 'message' => 'Product not found'));
                        $conn->close();
                        exit;
                    }
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Invalid order type'));
                    $conn->close();
                    exit;
                }
            }

            // Return the array of updated quantities in the JSON response
            echo json_encode(array('success' => true, 'message' => 'Quantities updated successfully', 'updated_quantities' => $updatedQuantities));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Invalid data format'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'User not logged in'));
    }

    // Close the database connection
    $conn->close();
?>

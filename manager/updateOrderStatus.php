<?php
    session_start();

    // Replace these with your actual database connection details
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "bwrs";

    $customer_order_table = "customer_order";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the JSON data from the request
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['order_id']) && isset($data['order_status']) && isset($data['user_id']) && isset($data['update_status_date'])) {
        $status_date = $data['update_status_date'];
        $user_id = $data['user_id'];
        $orderId = $data['order_id'];
        $orderStatus = $data['order_status'];

        if($orderStatus === 'In transit') {
            // Update the order status in the database
            $updateOrderStatusQuery = "UPDATE $customer_order_table SET order_status = ?, transit_date = ? WHERE order_id = ? AND user_id = ?";
            $stmt = $conn->prepare($updateOrderStatusQuery);
            $stmt->bind_param("ssss", $orderStatus, $status_date, $orderId, $user_id);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Order status updated successfully"]);
            } else {
                echo json_encode(["success" => false, "error" => "Error updating order status: " . $conn->error]);
            }

            $stmt->close();
        }
        else if($orderStatus === 'To receive'){
            // Update the order status in the database
            $updateOrderStatusQuery = "UPDATE $customer_order_table SET order_status = ? WHERE order_id = ? AND user_id = ?";
            $stmt = $conn->prepare($updateOrderStatusQuery);
            $stmt->bind_param("sss", $orderStatus, $orderId, $user_id);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Order status updated successfully"]);
            } else {
                echo json_encode(["success" => false, "error" => "Error updating order status: " . $conn->error]);
            }

            $stmt->close();
        }else {
            echo json_encode(["success" => false, "error" => "Invalid order status"]);
        }

        
    } else {
        echo json_encode(["success" => false, "error" => "Invalid request"]);
    }

    // Close the database connection
    $conn->close();
?>

<?php

    session_start();

    if (!isset($_SESSION['user_id'])) {
        $response = array('error' => 'Unauthorized access. Please log in.');
        echo json_encode($response);
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bwrs";

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            throw new Exception('Connection failed: ' . $conn->connect_error);
        }

        $dataJSON = file_get_contents("php://input");
        $data = json_decode($dataJSON, true);

        $orderData = $data['order_ids'];
        $completionDate = $data['completion_date'];
        $orderStatus = "Completed";

        $successMessages = [];
        $updatedOrders = []; // Array to store updated order data

        foreach ($orderData as $orderId) {
            $userId = $_SESSION['user_id'];

            $sql = "UPDATE customer_order SET order_status = ?, completion_date = ? WHERE order_id = ? AND user_id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $orderStatus, $completionDate, $orderId, $userId);

            if ($stmt->execute()) {
                $successMessages[] = "Order status updated successfully for order ID: $orderId";

                // Fetch the updated data for the specific order with joins
                $selectSql = " SELECT co.*, co_items.*, p.* 

                    FROM customer_order co
                    JOIN checkout_order co_items ON co.order_id = co_items.order_id
                    JOIN products p ON co_items.product_id = p.product_id
                    WHERE co.order_id = ? AND co.user_id = ?
                ";

                $selectStmt = $conn->prepare($selectSql);
                $selectStmt->bind_param("ss", $orderId, $userId);
                $selectStmt->execute();

                $result = $selectStmt->get_result();
                $updatedOrderData = $result->fetch_assoc();
                $updatedOrders[] = $updatedOrderData;
            } else {
                throw new Exception("Error updating order status for order ID: $orderId. Error: " . $stmt->error);
            }
        }

        echo json_encode(['success' => true, 'messages' => $successMessages, 'updated_orders' => $updatedOrders]);
    } catch (Exception $e) {
        $response = array('success' => false, 'error' => 'An error occurred: ' . $e->getMessage());
        echo json_encode($response);
    } finally {
        if (isset($conn)) {
            $conn->close();
        }
    }
?>

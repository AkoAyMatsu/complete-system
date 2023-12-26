<?php
session_start();

$host = "localhost";
$user_db = "root";
$pass_db = "";
$name_db = "bwrs";

$orderTable = "customer_order";
$checkoutTable = "checkout";
$checkoutOrderTable = "checkout_order";
$paymentTable = "payment";

$conn = mysqli_connect($host, $user_db, $pass_db, $name_db);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("User not logged in");
        }

        $userId = $_SESSION['user_id'];

        $data = file_get_contents("php://input");

        if (empty($data)) {
            throw new Exception("Empty JSON");
        }

        $cancelData = json_decode($data, true);

        if ($cancelData === null) {
            throw new Exception("Invalid JSON input");
        }

        // Extract data from cancelData
        $checkout_id = $cancelData["checkout_id"];
        $order_ids = $cancelData["order_ids"];
        $payment_ids = $cancelData["payment_ids"];
        $cancellation_date = $cancelData['cancel_date'];
        $cancelledStatus = "Cancelled";

        // Check the status of each order before canceling
        $checkOrderStatusQuery = "SELECT order_id, order_status FROM $orderTable WHERE order_id IN ('" . implode("','", $order_ids) . "') AND user_id = '$userId'";
        $result = $conn->query($checkOrderStatusQuery);

        $ordersToCancel = [];
        while ($row = $result->fetch_assoc()) {
            $order_id = $row["order_id"];
            $order_status = $row["order_status"];

            // Check if the order is in "Pending" status before canceling
            if ($order_status === "Pending") {
                $ordersToCancel[] = $order_id;
            } else {
                // If an order is not in "Pending" status, log an error or handle it accordingly
                throw new Exception("Order $order_id is not in 'Pending' status and cannot be canceled.");
            }
        }

        if (empty($ordersToCancel)) {
            // No valid orders to cancel
            throw new Exception("No valid orders found for cancellation.");
        }

        // Update order status to "Cancelled" in customer_order table
        $updateOrderStatusQuery = "UPDATE $orderTable SET order_status = '$cancelledStatus', cancel_date = '$cancellation_date' WHERE order_id IN ('" . implode("','", $ordersToCancel) . "') AND user_id = '$userId'";
        if (!$conn->query($updateOrderStatusQuery)) {
            throw new Exception($conn->error);
        }

        // Select cancelled items from customer_order table
        $selectCancelledItemsQuery = "SELECT * FROM $orderTable WHERE order_id IN ('" . implode("','", $ordersToCancel) . "') AND order_status = 'Cancelled' AND user_id = '$userId'";
        $cancelledItemsResult = $conn->query($selectCancelledItemsQuery);

        $cancelledItems = [];
        while ($row = $cancelledItemsResult->fetch_assoc()) {
            $cancelledItems[] = $row;
        }

        echo json_encode([
            "success" => true,
            "msg" => "Order cancelled successfully!",
            "cancelled_items" => $cancelledItems
        ]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}

$conn->close();
?>

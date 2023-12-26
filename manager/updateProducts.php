<?php
    // Start or resume the session
    session_start();

    // Assuming you have a database connection established
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bwrs";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // User is logged in, get the user ID from the session
        $userId = $_SESSION['user_id'];

        // Get data from the AJAX request
        $data = json_decode(file_get_contents("php://input"));

        // Validate product quantity
        $productQuantity = $data->productQuantity;
        if (!ctype_digit($productQuantity) || $productQuantity <= 0) {
            $response = array('status' => 'error', 'message' => 'Invalid product quantity');
            echo json_encode($response);
            exit;
        }

        $productId = $data->productId;

        $productTable = 'products';

        // Update the product quantity in the database, associating it with the user ID
        $sql = "UPDATE $productTable SET product_quantity = ? WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $productQuantity, $productId);

        if ($stmt->execute()) {
            $response = array(
                'status' => 'success',
                'message' => 'Product quantity updated successfully',
                'updatedQuantity' => $productQuantity,
                'product_id' => $productId
            );
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'Error updating product quantity');
            echo json_encode($response);
        }

        $stmt->close();
    } else {
        // User is not logged in, handle accordingly
        $response = array('status' => 'error', 'message' => 'User not logged in');
        echo json_encode($response);
    }

    $conn->close();
?>

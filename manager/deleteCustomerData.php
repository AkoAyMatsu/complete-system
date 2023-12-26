<?php
    // Start or resume a session
    session_start();

    // Check if the request method is DELETE
    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
        $response = array('success' => false, 'message' => 'Invalid request method.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        $response = array('success' => false, 'message' => 'User not logged in.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Replace these variables with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bwrs";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the customerId parameter is set in the DELETE request
    if (isset($_GET['userId'])) {
        $customerId = $_GET['userId'];

        // Prepare and execute the SQL statement to delete the customer
        $stmt = $conn->prepare("DELETE FROM customer WHERE user_id = ?");
        $stmt->bind_param("s", $customerId);

        if ($stmt->execute()) {
            $response = array('success' => true, 'message' => 'Customer deleted successfully.');
        } else {
            $response = array('success' => false, 'message' => 'Error deleting customer: ' . $conn->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        $response = array('success' => false, 'message' => 'customerId parameter not provided.');
    }

    // Close the database connection
    $conn->close();

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
?>

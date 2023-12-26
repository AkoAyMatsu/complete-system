<?php
    // Start or resume the session

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        $response = array('status' => 'error', 'message' => 'User not logged in');
        echo json_encode($response);
        exit;
    }

    // Assuming you have a database connection established
    $servername = "localhost";
    $server_username = "root";
    $server_password = "";
    $dbname = "bwrs"; // Replace with your actual database name

    $conn = new mysqli($servername, $server_username, $server_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $employee_data = array();

    // Query to retrieve all customer data
    $sql = "SELECT * FROM employee";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch all rows and store them in an array
        while ($row = $result->fetch_assoc()) {
            $employee_data[] = $row;
        }
    }

    // Close the database connection
    $conn->close();

    // Build the response array
    $response = array(
        'status' => 'success',
        'message' => 'Employee data retrieved successfully',
        'employee' => $employee_data
    );

   // Encode the array as JSON and generate JavaScript code
    echo '<script>console.log(' . json_encode($response) . ')</script>';
?>

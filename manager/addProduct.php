<?php
// Start the session (add this at the beginning of your script)
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Function to sanitize input data
    function sanitizeInput($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Validate and sanitize form data
    $productName = isset($_POST['productName']) ? sanitizeInput($_POST['productName']) : '';
    $productBuyPrice = isset($_POST['productBuyPrice']) ? sanitizeInput($_POST['productBuyPrice']) : '';
    $productRefillPrice = isset($_POST['productRefillPrice']) ? sanitizeInput($_POST['productRefillPrice']) : '';
    $productBorrowPrice = isset($_POST['productBorrowPrice']) ? sanitizeInput($_POST['productBorrowPrice']) : '';
    $productQuantity = isset($_POST['productQuantity']) ? sanitizeInput($_POST['productQuantity']) : '';

     // Check file extension
     $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
     $fileExtension = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));

     $errors = [];

     // Validation checks for each variable
     switch (true) {
         case empty($productName):
         case empty($productBuyPrice):
         case empty($productRefillPrice):
         case empty($productBorrowPrice):
         case empty($productQuantity):
             $errors[] = 'All fields are required';
             break;
     
         case !ctype_digit($productBuyPrice):
         case !ctype_digit($productRefillPrice):
         case !ctype_digit($productBorrowPrice):
         case !ctype_digit($productQuantity):
             $errors[] = 'Numeric fields should be valid numbers';
             break;
     
         case !in_array($fileExtension, $allowedExtensions):
             $errors[] = 'Invalid image file format! Allowed formats: jpeg, png, gif';
             break;
     
         case empty($_FILES['product_image']['name']):
             $errors[] = 'Empty image file!';
             break;
     }

    // Check if user is logged in (user_id is set in the session)
    if (!isset($_SESSION['user_id'])) {
        $errors[] = 'User not logged in';
    }

    if (empty($errors)) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "bwrs";
        $products_table = "products";

        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle file upload
        $targetDirectory = "../../bwrs/sample_images/product"; // Adjust the target directory as needed
        $targetFile = $targetDirectory . basename($_FILES["product_image"]["name"]);

        // You may want to add more checks and handling for file uploads
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            // Generate a unique product ID
            $product_id = generateUniqueRandomId($conn, $products_table, 'product_id');

            // Save data to the database
            $insertQuery = "INSERT INTO $products_table (product_id, product_type, product_buy_price, product_refill_price, product_borrow_price, product_quantity, product_img)
                            VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sssssss", $product_id, $productName, $productBuyPrice, $productRefillPrice, $productBorrowPrice, $productQuantity, $targetFile);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Product added successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error saving product data to the database']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading product image']);
        }

        $conn->close();
    } else {
        // Return errors as JSON
        echo json_encode(['success' => false, 'errors' => $errors]);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

// Function to generate a unique random ID
function generateUniqueRandomId($conn, $table_name, $column_name)
{
    $prefix = "133";
    $maxAttempts = 10; // Adjust as needed to prevent an infinite loop

    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
        $randomIdNumber = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
        $newId = $prefix . $randomIdNumber;

        // Check if the generated ID already exists in the table
        $checkQuery = "SELECT COUNT(*) AS count FROM $table_name WHERE $column_name = '$newId'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->fetch_assoc()['count'] == 0) {
            return $newId; // Unique ID found, return it
        }
    }

    // If maxAttempts is reached, you may want to handle this differently (throw an exception, log an error, etc.)
    return null;
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "1602";
$dbname = "mydatabase";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the customer1 table if it doesn't exist
$createTableSql = "CREATE TABLE IF NOT EXISTS customer1 (
    OrderDate DATE,
    Company VARCHAR(50),
    Owner VARCHAR(50),
    Item VARCHAR(100),
    Quantity VARCHAR(50),
    Weight FLOAT,
    RequestForShipment VARCHAR(100),
    TrackingId VARCHAR(50),
    ShipmentSize VARCHAR(50),
    BoxCount INT,
    Specification VARCHAR(100),
    ChecklistQuantity VARCHAR(50)
)";

if ($conn->query($createTableSql) === FALSE) {
    echo "Error creating table: " . $conn->error;
    exit();
}

// Retrieve the submitted form data
$orderDate = $_POST['order_date'];
$company = $_POST['company'];
$owner = $_POST['owner'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$weight = $_POST['weight'];
$shipmentRequest = $_POST['shipment_request'];
$trackingId = $_POST['tracking_id'];
$shipmentSize = $_POST['shipment_size'];
$boxCount = $_POST['box_count'];
$specification = $_POST['specification'];
$checklistQuantity = $_POST['checklist_quantity'];

// Validate the form data
$errors = [];

// ... Validation code omitted for brevity ...

// If there are any validation errors, display them and stop further processing
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit();
}

// Prepare and execute the SQL statement to insert the form data into the customer1 table
$stmt = $conn->prepare("INSERT INTO customer1 (OrderDate, Company, Owner, Item, Quantity, Weight, RequestForShipment, TrackingId, ShipmentSize, BoxCount, Specification, ChecklistQuantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $orderDate, $company, $owner, $item, $quantity, $weight, $shipmentRequest, $trackingId, $shipmentSize, $boxCount, $specification, $checklistQuantity);

if ($stmt->execute()) {
    echo "Data saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

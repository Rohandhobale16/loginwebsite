<?php
$servername = "localhost";
$username = "root";
$password = "1602";
$dbname = "mydatabase";

// Check if the user is logged in with admin ID (you need to implement this logic)

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the database to retrieve the necessary data
$sql = "SELECT SUM(Quantity) AS customer1Quantity, SUM(Weight) AS customer1Weight, SUM(BoxCount) AS customer1BoxCount FROM customer1";
$result = $conn->query($sql);
$customer1Data = $result->fetch_assoc();

$sql = "SELECT SUM(Quantity) AS customer2Quantity, SUM(Weight) AS customer2Weight, SUM(BoxCount) AS customer2BoxCount FROM customer2";
$result = $conn->query($sql);
$customer2Data = $result->fetch_assoc();

// Calculate the total quantities, weights, and box counts
$totalQuantity = $customer1Data['customer1Quantity'] + $customer2Data['customer2Quantity'];
$totalWeight = $customer1Data['customer1Weight'] + $customer2Data['customer2Weight'];
$totalBoxCount = $customer1Data['customer1BoxCount'] + $customer2Data['customer2BoxCount'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Data Summary</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Customer Data Summary</h2>
    <table>
        <tr>
            <th>Item/Customer</th>
            <th>Customer1</th>
            <th>Customer2</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><?php echo $customer1Data['customer1Quantity']; ?></td>
            <td><?php echo $customer2Data['customer2Quantity']; ?></td>
            <td><?php echo $totalQuantity; ?></td>
        </tr>
        <tr>
            <td>Weight</td>
            <td><?php echo $customer1Data['customer1Weight']; ?></td>
            <td><?php echo $customer2Data['customer2Weight']; ?></td>
            <td><?php echo $totalWeight; ?></td>
        </tr>
        <tr>
            <td>Box Count</td>
            <td><?php echo $customer1Data['customer1BoxCount']; ?></td>
            <td><?php echo $customer2Data['customer2BoxCount']; ?></td>
            <td><?php echo $totalBoxCount; ?></td>
        </tr>
    </table>
</body>
</html>

<?php
$conn->close();
?>

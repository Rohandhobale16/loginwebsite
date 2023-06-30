<?php
$hostname = "localhost"; // Change if your database is hosted elsewhere
$username = "root"; // Change to your MySQL username
$password = "1602"; // Change to your MySQL password
$database = "mydatabase"; // Change if you used a different database name

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database for the entered credentials
$sql = "SELECT * FROM auth WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

// Check if a matching user was found
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    // Redirect to the appropriate page based on the user's role
    if ($user['username'] == 'admin') {
        // Redirect to the admin page
        header("Location: admin.php");
        exit();
    } elseif ($user['username'] == 'customer1') {
        // Redirect to the customer 1 page
        header("Location: customer1.html");
        exit();
    } elseif ($user['username'] == 'customer2') {
        // Redirect to the customer 2 page
        header("Location: customer2.html");
        exit();
    }
} else {
    // Invalid credentials, redirect back to the login page
    header("Location: index.html");
    exit();
}

$conn->close();
?>

<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";  // Ensure this matches your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get data from the form and sanitize it
    $where_to = $conn->real_escape_string($_POST['where_to']);
    $how_many = $conn->real_escape_string($_POST['how_many']);
    $time_arrival = $conn->real_escape_string($_POST['time_arrival']);
    $leaving_time = $conn->real_escape_string($_POST['leaving_time']);

    // Prepare SQL query to insert data into the "booking" table
    $sql = "INSERT INTO booking (where_to, how_many, time_arrival, leaving_time) 
            VALUES ('$where_to', '$how_many', '$time_arrival', '$leaving_time')";

    // Execute query and check if it's successful
    if ($conn->query($sql) === TRUE) {
        echo "Booking saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

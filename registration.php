<?php
// Database connection
$servername = "localhost";
$username = "root";  // Replace with your MySQL username
$password = "";  // Replace with your MySQL password
$dbname = "user_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Check if the email already exists in the database
    $email_check_sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($email_check_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "Error: This email is already registered. Please use another email.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert new user
        $sql = "INSERT INTO users (fullname, email, password, phone, address)
                VALUES (?, ?, ?, ?, ?)";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $fullname, $email, $hashed_password, $phone, $address);

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration successful!";
            // Redirect to login page after successful registration
            header("Location: login.php");  // Adjust the path as needed
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

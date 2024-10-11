<?php
// Database configuration
$config = [
    'db_host' => 'localhost',
    'db_name' => 'jtour',
    'db_user' => 'root',
    'db_pass' => '',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']}", $config['db_user'], $config['db_pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->execute(['email' => $email, 'password' => $password]);

        // Return a success message
        echo "User registered successfully!";
    } catch (PDOException $e) {
        // Return an error message
        echo "Error: " . $e->getMessage();
    }
}
?>

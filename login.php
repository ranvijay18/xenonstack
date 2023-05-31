<?php
// Database connection details
$host = 'localhost';
$dbname = 'test';
$username = 'your_username';
$password = 'your_password';

// Connect to the database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $email, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username and password match a record in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->execute(array('email' => $email, 'password' => $password));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User authentication successful
        echo "Login successful!";
    } else {
        // User authentication failed
        echo "Invalid username or password!";
    }
}
?>

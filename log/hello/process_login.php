<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user input (sanitize and validate email and password)
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password']; // You should validate the password

    // Check user credentials in the database (adjust your database connection)
    $conn = new mysqli("localhost", "username", "password", "apnacab");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM customer WHERE c_email_id = '$email' AND c_password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        session_start();
        $_SESSION["user_email"] = $email;
        header("Location: dashboard.php"); // Redirect to a protected page
        exit;
    } else {
        // Invalid login
        echo "Invalid email or password. Please try again.";
    }

    $conn->close();
}
?>

<?php
session_start();
include 'koneksi.php';  // Include your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Using prepared statements to prevent SQL Injection
    $stmt = $conn->prepare("SELECT id, role FROM users WHERE username = ? AND password = MD5(?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $username;

        // Redirect to the admin dashboard if the login is successful
        header("Location: index_admin.php");
        exit();
    } else {
        // Redirect back to the login page with an error message if login fails
        header("Location: login.html?error=Invalid credentials");
        exit();
    }
    $stmt->close();
}
$conn->close();
?>

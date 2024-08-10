<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $stmt = $conn->prepare("INSERT INTO news (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        header("Location: index.html"); // Redirect to the news page
    } else {
        echo "Error adding news.";
    }
    $stmt->close();
}
$conn->close();
?>

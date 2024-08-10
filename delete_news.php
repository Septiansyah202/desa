<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        header("Location: index.html"); // Redirect back to the news page
    } else {
        echo "Error deleting news.";
    }
    $stmt->close();
}
$conn->close();
?>

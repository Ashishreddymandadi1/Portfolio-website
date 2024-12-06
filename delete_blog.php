<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: register.php?error=You need to login to access this page");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'portfolio_db');
$user_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    die("Blog ID is required");
}

$blog_id = $_GET['id'];

$sql = "SELECT * FROM blogs WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $blog_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Blog not found or you don't have permission to delete it.");
}

$delete_stmt = $conn->prepare("DELETE FROM blogs WHERE id = ? AND user_id = ?");
$delete_stmt->bind_param("ii", $blog_id, $user_id);
if ($delete_stmt->execute()) {
    echo "Blog deleted successfully!";
} else {
    echo "Error: " . $delete_stmt->error;
}

$delete_stmt->close();
$stmt->close();

header("Location: blog.php");
exit();
?>

<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect_to=edit_blog.php");
    exit();
}


// Database connection
$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

// Check if the blog ID is passed in the URL
if (isset($_GET['id'])) {
    $blog_id = $_GET['id'];
    $user_id = $_SESSION['user_id']; // Ensure 'user_id' is set in the session
    $username = $_SESSION['username']; // Ensure 'username' is also set in the session

    // Fetch the current blog details from the database
    $stmt = $conn->prepare("SELECT content, image_path FROM blogs WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $blog_id, $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($content, $image_path);
    
    if ($stmt->num_rows == 0) {
        die("Blog not found or you do not have permission to edit this blog.");
    }
    $stmt->fetch();
    $stmt->close();
} else {
    die("No blog ID provided.");
}

// Handle blog update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_content = $_POST['blog_content'];
    $new_image_path = $image_path; // Keep the same image if not uploading new one

    // Handle new image upload
    if (isset($_FILES["blog_image"]) && $_FILES["blog_image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["blog_image"]["name"]);

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if not exists
        }

        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file)) {
            $new_image_path = $target_file;
        } else {
            die("Failed to upload image.");
        }
    }

    // Update the blog in the database
    $update_stmt = $conn->prepare("UPDATE blogs SET content = ?, image_path = ? WHERE id = ? AND user_id = ?");
    $update_stmt->bind_param("ssii", $new_content, $new_image_path, $blog_id, $user_id);
    if ($update_stmt->execute()) {
        // Redirect back to the blog page after updating
        header("Location: blog.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $update_stmt->error;
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Blog</h2>
    <form method="POST" enctype="multipart/form-data">
        <textarea name="blog_content" placeholder="Write your blog content here..." required><?php echo htmlspecialchars($content); ?></textarea><br>
        <input type="file" name="blog_image" accept="image/*"><br>
        <?php if ($image_path): ?>
            <img src="<?php echo $image_path; ?>" alt="Current Image" style="max-width: 200px; max-height: 200px;"><br>
        <?php endif; ?>
        <button type="submit">Update Blog</button>
    </form>
</body>
</html>

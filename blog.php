<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect_to=blog.php");
    exit();
}


// Database connection
$conn = new mysqli('localhost', 'root', '', 'portfolio_db');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; // Ensure 'username' is also set in the session

// Insert blog post if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['blog_content'];
    $image_path = null;

    
    if (isset($_FILES["blog_image"]) && $_FILES["blog_image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["blog_image"]["name"]);

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            die("Failed to upload image.");
        }
    }

    $stmt = $conn->prepare("INSERT INTO blogs (user_id, username, content, image_path) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("isss", $user_id, $username, $content, $image_path);
    if ($stmt->execute()) {
        echo "Blog posted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$sql = "SELECT * FROM blogs ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blogs</title>
    <link rel="stylesheet" href="styles.css">
    <style>

.blog-list {
    background-color: black;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
    margin-top: 20px;
}

.post-blog-container {
    margin-top: 20px; 
    padding: 20px;
    background-color: black;
    box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
    z-index: 10;
    position: relative; 
    width: 100%;
}

.post-blog-container h2 {
    text-align: center;
    font-size: 24px;
    color: white;
    margin-bottom: 20px;
}

.post-blog-container form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    align-items: center;
}

.post-blog-container textarea {
    width: 60%;
    height: 120px;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: none;
}

.post-blog-container input[type="file"] {
    width: 30%;
    padding: 5px;
    font-size: 14px;
}

.post-blog-container button {
    padding: 12px 25px;
    font-size: 16px;
    color: #fff;
    background-color: #4CAF50;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.post-blog-container button:hover {
    background-color: #45a049;
}


        .blog-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 15px;
    width: 300px; 
    height: 400px; 
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    float: left;
    overflow: hidden;
}

.blog-card img {
    max-width: 100%;
    max-height: 150px;
    border-radius: 8px;
    object-fit: cover;
}

.blog-card h3 {
    font-size: 20px;
    margin: 10px 0;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.blog-card p {
    font-size: 14px;
    text-align: justify;
    margin: 10px 0;
    height: 80px; 
    overflow: hidden;
    text-overflow: ellipsis; 
}

.blog-card .created-at {
    font-size: 12px;
    color: #555;
    margin-top: auto;
}

.blog-card .button-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin-top: 10px;
}

.blog-card .edit-btn, .blog-card .delete-btn {
    padding: 5px 10px;
    text-decoration: none;
    color: #fff;
    border-radius: 5px;
    flex: 1;
    margin: 0 5px; 
    text-align: center;
}

.blog-card .edit-btn {
    background-color: #4CAF50;
}

.blog-card .delete-btn {
    background-color: #f44336;
}
.logo{
  display:flex;
}
.logo h2{
  padding-top:7px;
}

    </style>
</head>
<body>

<header>
      <nav class="taskbar">
          <div class="logo">
              <div><img src="logo.png" alt="Logo"></div>
              <div><h2>PORTFOLIO</h2></div>
          </div>
          
          <ul class="nav-links">
            <li><a href="index.php#about">ABOUT</a></li>
            <li class="dropdown"><a href="#photos" class="dropbtn">PHOTOS</a>
              <ul class="dropdown-content">
                <li><a href="gallery.php?category=travel">Travel</a></li>
                <li><a href="gallery.php?category=street">Street</a></li>
                <li><a href="gallery.php?category=commercial">Commercial</a></li>
                <li><a href="gallery.php?category=wildlife">Wildlife</a></li>
                <li><a href="gallery.php?category=event">Event</a></li>
              </ul>
            </li>
            
            <li><a href="beforeafter.php">PRESETS</a></li>
            <li><a href="videos.php">CONTENT</a></li>
            <li><a href="blog.php">BLOGS</a></li>
            <?php if (isset($_COOKIE['username'])): ?>
              <li>Hello, <?php echo htmlspecialchars($_COOKIE['username']); ?> | <a href="logout.php">LOGOUT</a></li>
            <?php else: ?>

            <li><a href="login.php">LOGIN</a></li>
        <?php endif; ?>
        </ul>
      </nav>
    </header>
    

    <div class="post-blog-container">
    <h2>Post a Blog</h2>
    <form method="POST" enctype="multipart/form-data">
        <textarea name="blog_content" placeholder="Write your blog content here..." required></textarea><br>
        <input type="file" name="blog_image" accept="image/*"><br>
        <button type="submit">Post Blog</button>
    </form>
    </div>

    <h2 class="myh2">All Blogs</h2>
    <div class="blog-list">
        <?php
        // Display all the blogs as cards
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $content = $row['content'];
                $image_path = $row['image_path'];
                $created_at = $row['created_at'];
                ?>
                <div class="blog-card">
                    <?php if ($image_path): ?>
                        <img src="<?= $image_path ?>" alt="Blog Image">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($row['username']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($content)) ?></p>
                    <div class="created-at"><?= $created_at ?></div>
                    <?php if ($row['user_id'] == $user_id): ?>
                        <!-- Edit and Delete buttons only for the current user -->
                        <div class="button-container">
    <a href="edit_blog.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
    <a href="delete_blog.php?id=<?= $row['id'] ?>" class="delete-btn">Delete</a>
</div>

                    <?php endif; ?>
                </div>
                <?php
            }
        } else {
            echo "<p>No blogs found.</p>";
        }
        ?>
    </div>
    
</body>
</html>

<?php
$conn->close();
?>

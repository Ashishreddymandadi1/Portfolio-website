<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$category = isset($_GET['category']) ? $_GET['category'] : 'event';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['photo_id'])) {
    $photo_id = intval($_POST['photo_id']); 

    // Check if the user already liked this photo
    if (!isset($_SESSION['liked_photos'][$photo_id])) {
        // Update the like count in the database
        $stmt = $conn->prepare("UPDATE photos SET like_count = like_count + 1 WHERE photo_id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $photo_id);
            $stmt->execute();
            $stmt->close();

            // Store the liked photo in the session
            $_SESSION['liked_photos'][$photo_id] = true;
        } else {
            echo "Error in SQL query: " . $conn->error;
        }
    }
}

$stmt = $conn->prepare("SELECT * FROM photos WHERE category = ?");
if ($stmt) {
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    die("Error in SQL query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($category); ?> Photo Gallery</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .header {
            background-color: black;
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

<div class="header"><?php echo ucfirst($category); ?> Gallery</div>

<div class="gallery">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="photo-card">
            <img src="images/<?php echo htmlspecialchars($row['filename']); ?>" alt="<?php echo ucfirst($category); ?> Photo">
            <div class="photo-actions">
                <form method="post">
                    <input type="hidden" name="photo_id" value="<?php echo htmlspecialchars($row['photo_id']); ?>">
                    <button type="submit" class="like-btn">
                        <?php echo isset($_SESSION['liked_photos'][$row['photo_id']]) ? "Liked ❤️" : "Like ❤️"; ?>
                    </button>
                </form>
                <span class="like-count"><?php echo htmlspecialchars($row['like_count']); ?> Likes</span>
            </div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>

<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "portfolio_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect_to=event.php");
    exit();
}

// Handle like action
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['photo_id'])) {
        $photo_id = $_POST['photo_id'];

        // Check if the user has already liked the photo (using session)
        if (!isset($_SESSION['liked_photos'][$photo_id])) {
            // Update the like count in the database
            $stmt = $conn->prepare("UPDATE photos SET like_count = like_count + 1 WHERE photo_id = ?");
            $stmt->bind_param("s", $photo_id);
            $stmt->execute();

            // Mark the photo as liked in the session
            $_SESSION['liked_photos'][$photo_id] = true;
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Event Series</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
      <nav class="taskbar">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <ul class="nav-links">
                <li><a href="index.php#about">ABOUT</a></li>
                <li class="dropdown">
                    <a href="#photos" class="dropbtn">PHOTOS</a>
                    <ul class="dropdown-content">
                        <li><a href="travel.php">Travel</a></li>
                        <li><a href="street.php">Street</a></li>
                        <li><a href="wildlife.php">Wildlife</a></li>
                        <li><a href="commercial.php">Commercial</a></li>
                        <li><a href="event.php">Event</a></li>
                    </ul>
                </li>
                <li><a href="#contact">CONTACT</a></li>

                <!-- Dynamic Login/Logout Button -->
                <?php if (isset($_SESSION['username'])): ?>
                    <li>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">LOGOUT</a></li>
                <?php else: ?>
                    <li><a href="login.php">LOGIN</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <div class="header1">My Travel Gallery</div>
    <div class="gallery">
    <?php
$photos = $conn->query("SELECT * FROM photos");
while ($row = $photos->fetch_assoc()):
    $photo_id = $row['photo_id'];
    $like_count = $row['like_count'];
?>
<div class="photo-card">
    <img src="images/<?php echo htmlspecialchars($row['photo_id']); ?>.jpg" alt="Photo">
    <div class="photo-actions">
        <form method="post">
            <input type="hidden" name="photo_id" value="<?php echo htmlspecialchars($photo_id); ?>">
            <button type="submit" class="like-btn">
                Like ❤️
            </button>
        </form>
        <span class="like-count"><?php echo htmlspecialchars($like_count); ?> Likes</span>
    </div>
</div>
<?php endwhile; ?>

</body>
</html>
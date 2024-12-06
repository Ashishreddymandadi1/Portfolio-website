<?php
session_start();
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : 'event';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['photo_id'])) {
    $photo_id = $_POST['photo_id'];

    if (!isset($_SESSION['liked_photos'][$photo_id])) {
        $stmt = $conn->prepare("UPDATE photos SET like_count = like_count + 1 WHERE photo_id = ?");
        $stmt->bind_param("i", $photo_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['liked_photos'][$photo_id] = true;
    }
}

$stmt = $conn->prepare("SELECT * FROM photos WHERE category = ?");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($category); ?> Photo Gallery</title>
    <link rel="stylesheet" href="style.css">
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
                    <li><a href="gallery.php?category=event">Event</a></li>
                    <li><a href="gallery.php?category=wildlife">Wildlife</a></li>
                    <li><a href="gallery.php?category=travel">Travel</a></li>
                    <li><a href="gallery.php?category=commercial">Commercial</a></li>
                    <li><a href="gallery.php?category=street">Street</a></li>
                </ul>
            </li>
            <li><a href="index.php#contact">CONTACT</a></li>

            <?php if (isset($_SESSION['username'])): ?>
                <li>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">LOGOUT</a></li>
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

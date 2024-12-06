<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php?redirect_to=commercial.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Commercial Series</title>
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
                <li><a href="index.php#contact">CONTACT</a></li>

                <!-- Dynamic Login/Logout Button -->
                <?php if (isset($_SESSION['username'])): ?>
                    <li>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">LOGOUT</a></li>
                <?php else: ?>
                    <li><a href="login.php">LOGIN</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <p>this is commercial page</p>

</body>
</html>

<?php
session_start();
session_destroy(); // Destroy session
setcookie("username", "", time() - 3600, "/"); // Clear the cookie
header("Location: index.php"); // Redirect to homepage
exit;
?>

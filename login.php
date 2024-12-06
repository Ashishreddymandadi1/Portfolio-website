<?php

session_start();
$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Set a cookie for the username 
            setcookie("username", $user['username'], 0, "/");

            $target_page = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : 'blog.php';
            header("Location: $target_page");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this email!";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style1.css">
    <script src="loginscript.js"></script>
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-in-container">
    
    <form method="POST" action="?redirect_to=<?php echo htmlspecialchars($_GET['redirect_to'] ?? 'index.php'); ?>">
    <h1>Login</h1>
    <br>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    </div>
	<div class="overlay-container">
		<div class="overlay">
			
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<a class="ghost" href="register.php">Sign Up</a></button>
			</div>
		</div>
	</div>
</div>
</body>
</html>

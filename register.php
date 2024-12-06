<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $check_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_user->bind_param("s", $email);
    $check_user->execute();
    $check_user->store_result();

    if ($check_user->num_rows > 0) {
        echo "User already exists. Please <a href='login.php'>login here</a>.";
    } else {
        $sql = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $username, $email, $password);
        if ($sql->execute()) {
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $sql->error;
        }
        $sql->close();
    }
    $check_user->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style1.css">
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".register-form");

    form.addEventListener("submit", function (event) {
        const errorMessages = document.querySelectorAll(".error-text");
        errorMessages.forEach((msg) => msg.remove());

        let hasError = false;

        const username = document.getElementById("username");
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");

        if (username.value.trim() === "") {
            showError(username, "Username is required.");
            hasError = true;
        } else if (username.value.length < 3) {
            showError(username, "Username must be at least 3 characters.");
            hasError = true;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() === "") {
            showError(email, "Email is required.");
            hasError = true;
        } else if (!emailRegex.test(email.value)) {
            showError(email, "Invalid email address.");
            hasError = true;
        }

        const passwordRegex = /^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/;
        // const passwordRegex=`^[A-Za-z]{4}$`;
        if (password.value.trim() === "") {
            showError(password, "Password is required.");
            hasError = true;
        } else if (!passwordRegex.test(password.value)) {
            showError(password, "Password must have at least 8 characters and include letters and numbers.");
            hasError = true;
        }

        if (confirmPassword.value.trim() === "") {
            showError(confirmPassword, "Please confirm your password.");
            hasError = true;
        } else if (confirmPassword.value !== password.value) {
            showError(confirmPassword, "Passwords do not match.");
            hasError = true;
        }

        if (hasError) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        const errorText = document.createElement("p");
        errorText.className = "error-text";
        errorText.style.color = "red";
        errorText.style.marginTop = "5px";
        errorText.textContent = message;
        input.parentElement.appendChild(errorText);
    }
});
    </script>
</head>
<body>
<div class="container" id="container">
<div class="form-container sign-in-container">
    
    <form method="POST" action="" class="register-form">
    <h1>Create Account</h1><br>
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required><br>
        <br>
        <button type="submit">Register</button>
    </form>
    </div>
	
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<a class="ghost" href="login.php">Sign In</a></button>
			</div>
			
		</div>
	</div>
</div>

</body>
</html>

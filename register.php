<?php
session_start();

$users_file = "users.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "All fields are required. <a href='register.php'>Try again</a>";
        exit();
    }

    $users = file_exists($users_file) ? json_decode(file_get_contents($users_file), true) : [];

    if (isset($users[$username])) {
        echo "Username already exists. <a href='register.php'>Try again</a>";
        exit();
    }

    $users[$username] = password_hash($password, PASSWORD_DEFAULT);

    file_put_contents($users_file, json_encode($users));

    echo "Account created successfully! <a href='index.php'>Login</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Create Account</h2>
    <form action="register.php" method="post">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="index.php">Login here</a></p>
</body>
</html>

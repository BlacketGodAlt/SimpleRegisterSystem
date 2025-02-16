<?php
session_start();

$users_file = "users.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!file_exists($users_file)) {
        echo "No users registered. <a href='register.php'>Create an account</a>";
        exit();
    }

    $users = json_decode(file_get_contents($users_file), true);

    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid credentials. <a href='index.php'>Try again</a>";
    }
}
?>

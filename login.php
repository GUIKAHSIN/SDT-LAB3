<?php
session_start(); // Ensure session starts before HTML output
include 'bootstrap.html';
include 'lab3_db.php'; // Database connection

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users_reg WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("location: read.php");
            exit();
        } else {
            echo '<div class="alert alert-danger text-center">Invalid username or password</div>';
        }
    } else {
        echo '<div class="alert alert-warning text-center">No user found with that username</div>';
    }
}
?>

<html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body style="font-family: 'Times New Roman', Times, serif;">
    <div class="container" style="margin-top: 66px;">
        <h2 class="text-center mb-4">Login</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="login.php" method="POST" class="border p-4 shadow-sm rounded">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <!-- Set button type to 'submit' to allow form submission -->
                    <button type="submit" class="btn btn-info w-100 text-white rounded">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="register_main.php">Don't have an account? Register here</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

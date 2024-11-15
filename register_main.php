<?php
session_start();
include "lab3_db.php"; // Using database connection file here

$success_message = ''; // Initialize the success message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Get the username value from the form
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Insert the new user into the database
    $sql = "INSERT INTO users_reg (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        // If successful, assign the success message
        $success_message = '<div class="alert alert-success text-center">New record created successfully</div>';
    } else {
        // If there's an error, assign the error message
        $success_message = '<div class="alert alert-danger text-center">Error: ' . $sql . "<br>" . mysqli_error($conn) . '</div>';
    }
}
?>

<html>
<html lang="en">
<head>
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Times New Roman', Times, serif;">
    <div class="container" style="margin-top: 66px;">
        <!-- Success or error message appears here -->
        <?php echo $success_message; ?>
        
        <h2 class="text-center mb-4">Register</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="register_main.php" method="POST" class="border p-4 shadow-sm rounded">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control bg-success bg-opacity-10" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control bg-success bg-opacity-10" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 text-white rounded">Register</button>
                </form>
                <div class="text-center mt-3">
                    <a href="login.php">Already have an account? Login here</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

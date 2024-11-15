<?php
session_start();
if(!isset($_SESSION['username'])){ 
    header("Location: login.php"); 
    exit(); 
}
$username = $_SESSION['username']; 
?>

<html>
<head>
    <title>Student Information Registration System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: white; font-family: 'Times New Roman', Times, serif;">
    <!-- Navigation Bar -->
    <ul class="nav nav-pills justify-content-center mb-4">
        <li class="nav-item">
            <a class="nav-link active" href="read.php">Student List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php">Student Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">Log out</a>
        </li>
    </ul>

    <!-- Logo and welcome message -->
    <div class="text-center mb-4">
        <img src="UTM-LOGO-FULL.png" alt="UTM logo" width="300" height="100">
    </div>

    <h2 style="text-align:center; color: #4CAF50; font-weight:bold;">Welcome, <?php echo $username; ?>!</h2>

    <div class="container my-5">
        <h2 class="text-center mb-3">Student Information Registration List</h2>

        <!-- Table for displaying students -->
        <table class="table table-bordered table-striped table-hover text-center mx-auto" style="width: 80%;">
            <thead class="table-primary" style="line-height: 2.5;">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Matric</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Programme</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody style="line-height: 1.5;">
                <?php
                include 'lab3_db.php';

                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $counter = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$counter++."</td>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['matric']."</td>";
                        echo "<td>".$row['gender']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['program']."</td>";
                        echo "<td><a href='update.php?id=".$row['id']."' class='btn btn-warning btn-sm'>Edit</a></td>";
                        echo "<td><a href='delete.php?id=".$row['id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No Data Found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Button to register new student -->
        <div class="text-center mt-4">
            <a href="register.php" class="btn btn-primary">Register New Student</a>
        </div>
    </div>
</body>
</html>

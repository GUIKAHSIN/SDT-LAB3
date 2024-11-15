<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
    }

    include 'lab3_db.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Information</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body style="background-color: white; font-family: 'Times New Roman', Times, serif;">

    <!-- Navigation Bar -->
    <ul class="nav nav-pills justify-content-center mb-4">
        <li class="nav-item">
            <a class="nav-link" href="read.php">Student List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php">Student Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">Log out</a>
        </li>
    </ul>

    <!-- Logo -->
    <div class="text-center mb-4">
        <img src="UTM-LOGO-FULL.png" alt="UTM logo" width="300" height="100">
    </div>

    <h2 class="text-center">Update Information</h2>
    <p class="text-center">Resubmit your registration</p>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="update.php?id=<?php echo $row['id']; ?>" method="post" class="bg-success bg-opacity-25 p-4 rounded shadow-sm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="matric" class="form-label">Matric Number</label>
                        <input type="text" class="form-control" name="matric" value="<?php echo $row['matric']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="program" class="form-label">Programme</label>
                        <select id="program" name="program" class="form-select" required>
                            <option value="SECPH" <?php if($row['program']=='SECPH') echo 'selected'; ?>>Data Engineering</option>
                            <option value="SECJH" <?php if($row['program']=='SECJH') echo 'selected'; ?>>Software Engineering</option>
                            <option value="SECBH" <?php if($row['program']=='SECBH') echo 'selected'; ?>>Bioinformatics</option>
                            <option value="SECRH" <?php if($row['program']=='SECRH') echo 'selected'; ?>>Network and Security</option>
                            <option value="SECVH" <?php if($row['program']=='SECVH') echo 'selected'; ?>>Graphics and Multimedia Software</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <a href="read.php" class="btn btn-warning text-white">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $matric = $_POST['matric'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $program = $_POST['program'];

        $sql = "UPDATE users SET name='$name', matric='$matric', gender='$gender', email='$email', program='$program' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record updated successfully');window.location='read.php'</script>";
        } else {
            echo "<script>alert('Failed to update');window.location='read.php'</script>";
        }
    }
?>

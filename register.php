<?php
    session_start();
    if(!isset($_SESSION['username'])){ // If session is not set then redirect to Login Page
        header("Location: login.php"); //Redirecting To Login Page
        exit(); //Stop script
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Information Registration System</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body style="background-color: white; font-family: 'Times New Roman', Times, serif;">

    <!-- Navigation Bar -->
    <ul class="nav nav-pills justify-content-center mb-4">
        <li class="nav-item">
            <a class="nav-link" href="read.php">Student List</a>
       
        <li class="nav-item">
            <a class="nav-link active" href="register.php">Student Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">Log out</a>
        </li>
    </ul>

    <!-- Logo -->
    <div class="text-center mb-4">
        <img src="UTM-LOGO-FULL.png" alt="UTM logo" width="300" height="100">
    </div>

    <h1 class="text-center">REGISTRATION FORM</h1>
    <p class="text-center">Please fill in all the fields below for your course registration.<br>Thank you.</p>

    <!-- Registration Form -->
    <div class="container mt-4">
        <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="register.php" method="POST" class="bg-success bg-opacity-25 p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="FULL NAME" required>
            </div>
            <div class="mb-3">
                <label for="matric" class="form-label">Matric No</label>
                <input type="text" class="form-control" name="matric" placeholder="A23CS0088" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline" style="font-size:large;">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline" style="font-size:large;">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="xxxxx@gmail.com" required>
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Programme</label>
                <select id="program" name="program" class="form-select">
                    <option value="SECPH">Data Engineering</option>
                    <option value="SECJH">Software Engineering</option>
                    <option value="SECBH">Bioinformatics</option>
                    <option value="SECRH">Network and Security</option>
                    <option value="SECVH">Graphics and Multimedia Software</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="read.php" class="btn btn-warning text-white">Read Student Registration List</a>
        </div>
    </div>
    </body> 
</html>

<?php

    include 'lab3_db.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $matric = $_POST['matric'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $program = $_POST['program'];


            $sql = "INSERT INTO users (name, matric, gender, email, program) VALUES ('$name', '$matric', '$gender', '$email', '$program')";
            

            if(mysqli_query($conn, $sql)){
                echo "<script>alert('Register successfully');</script>";
            }else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    ?>
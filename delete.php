<?php

    include "lab3_db.php";

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $sql = "DELETE FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo"<script>alert('User Deleted Sucessfulyy'); window.location='read.php'</script>";
        }
        else{
            echo "<script>alert('User Not Deleted'); window.location='read.php'</script>";
        }
    }
?>
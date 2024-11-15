<?php
    session_start(); //Starting Session
    session_unset(); //Unset the session
    session_destroy(); //Destroy the session
    header("Location: login.php"); //Redirect to the main page
    exit(); // Stop script
?>
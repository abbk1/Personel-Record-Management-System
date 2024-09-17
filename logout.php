<?php 
include ("includes/header.php");

if (isset($_SESSION['user_role'])) {

    unset($_SESSION['user_role']);
    session_destroy();
}
    $_SESSION['user_role'] = "";
    $_SESSION['username'] = "";
    $_SESSION['user_email'] ="";
    $_SESSION['firstname'] = "";

    header("Location: login.php");die;


<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['user_name']);
// session_destroy();
header("Location: login_signup/login.php");

?>
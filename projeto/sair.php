<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['senha']);
header('location: tela-de-login.php');

?>
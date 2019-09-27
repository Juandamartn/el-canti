<?php
session_start();

if (isset($_SESSION['user'])) {
    $view = $_GET['view'];
    
    require 'views/index.view.php';
} else {
    header('Location:login.php');
}

?>

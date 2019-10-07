<?php
session_start();

if (isset($_SESSION['user'])) {
    require 'php/database.php';
    require 'private/config.php';
    
    $con = connection($db_config);
    $view = $_GET['view'];
    $count = orderCount($con);
    $countLength = count($count);
        
    require 'views/index.view.php';
} else {
    header('Location:login.php');
}
?>

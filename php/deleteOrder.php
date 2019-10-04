<?php
session_start();

if (isset($_SESSION['user'])) {
    require 'database.php';
    require '../private/config.php';
    
    $con = connection($db_config);
    $id = $_GET['id'];
    deleteOrder($con, $id);
    
    header('Location: ../index.php?view=home');
}
?>
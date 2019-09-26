<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

require 'private/config.php';
require 'php/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = '';

    $con = connection($db_config);

    $statement = $con->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $statement->execute();
    $result = $statement->fetch();
    
    if ($result !== false) {
        $_SESSION['user'] = $result['id_user'];
        header('Location: index.php');
    } else {
        $errors .= '<li><i class="fas fa-times"></i>Usuario o contraseña incorrectos</li>';
    }
}

require 'views/login.view.php';
?>

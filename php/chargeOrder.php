<?php
require 'database.php';
require '../private/config.php';

$con = connection($db_config);

insertSale($con, $_GET['chek'], $_GET['total']);
chargeOrder($con, $_GET['chek']);

header('Location: ../index.php?view=home');
?>
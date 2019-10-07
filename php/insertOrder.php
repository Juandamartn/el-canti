<?php
require 'database.php';
require '../private/config.php';

$con = connection($db_config);
$postLength = count($_POST);
$count = $postLength - 1;
$count = $count / 2;

for($i = 1; $i <= $count; $i++) {
    if (isset($_POST['check' . $i]) && $_POST['check' . $i] == 'on') {
        $combined = 1;
        $count -= 0.5;
    } else {
        $combined = 0;
    }
    
    insertFood($con, $_POST['idOrder'], $_POST['item' . $i], $_POST['id' . $i], $combined);
}

echo $count;
?>

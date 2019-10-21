<?php
require 'database.php';
require '../private/config.php';

$con = connection($db_config);
$postLength = count($_POST);

if (isset($_POST['deliver']) && $_POST['deliver'] == 'on') {
    $count = $postLength - 2;
    $count = $count / 2;
} else {  
    $count = $postLength - 1;
    $count = $count / 2;
}

echo $count . ' DELIVER: ' . $_POST['deliver'];

for($i = 1; $i <= $count; $i++) {
    if (isset($_POST['item' . $i]) && isset($_POST['id' . $i]) && isset($_POST['chek' . $i])) {
        continue;
    } else {
    }
}

for($i = 1; $i <= $count; $i++) {
    echo $count;
    if (isset($_POST['item' . $i]) && isset($_POST['id' . $i]) && isset($_POST['chek' . $i])) {
        echo 'no';
        continue;
    } else {
        echo 'si';
        if (isset($_POST['check' . $i]) && $_POST['check' . $i] == 'on' && isset($_POST['deliver']) == false) {
            $count -= 0.5;
            $combined = 1;
            $deliver = 0;
        } else if (isset($_POST['check' . $i]) && $_POST['check' . $i] == 'on' && isset($_POST['deliver']) && $_POST['deliver'] == 'on') {
            $count -= 0.5;
            $combined = 1;
            $deliver = 1;
        } else if (isset($_POST['deliver']) && $_POST['deliver'] == 'on') {
            $combined = 0;
            $deliver = 1;
        } else {
            $combined = 0;
            $deliver = 0;
        }

        insertFood($con, $_POST['idOrder'], $_POST['item' . $i], $_POST['id' . $i], $combined, $deliver);
    } 
}

//header('Location: ../index.php?view=home');

?>

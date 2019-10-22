<?php
require 'database.php';
require '../private/config.php';

$con = connection($db_config);

$last = end($_POST);

for($i = 1; $i <= $last; $i++) {
    if (isset($_POST['item' . $i]) && isset($_POST['id' . $i]) && isset($_POST['chek' . $i])) {
        continue;
    } else {
        
    }
}

for($i = 1; $i <= $last; $i++) {
    if (isset($_POST['item' . $i]) && isset($_POST['id' . $i]) && isset($_POST['chek' . $i])) {
        continue;
    } else {
        if (isset($_POST['check' . $i]) && $_POST['check' . $i] == 'on' && isset($_POST['deliver']) == false) {
            $combined = 1;
            $deliver = 0;
        } else if (isset($_POST['check' . $i]) && $_POST['check' . $i] == 'on' && isset($_POST['deliver']) && $_POST['deliver'] == 'on') {
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

header('Location: ../index.php?view=home');

?>

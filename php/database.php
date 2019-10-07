<?php
function connection($db_config) {
    try {
        $con = new PDO('mysql:host='.$db_config['host'].';dbname='.$db_config['database'].'', $db_config['user'], $db_config['pass']);
        return $con;
    } catch (PDOException $e) {
        echo "Error: ". $e->getMessage();
        return false;
    }
}

function orders($chek, $con) {
    $result = $con->query("SELECT sell.chek, food.name_food, ingredients.name_ing, sell.combined, food.price, sell.charged FROM sell INNER JOIN food ON sell.fk_id_food=food.id_food INNER JOIN ingredients ON ingredients.id_ing=sell.fk_id_ing WHERE charged = '0' AND chek = '$chek'");
    $result->execute();
    return $result->fetchAll();
}

function orderCount($con) {
    $result = $con->query("SELECT chek, charged FROM sell GROUP BY chek");
    $result->execute();
    return $result->fetchAll();
}

function deleteOrder($con, $id) {
    $result = $con->query("DELETE FROM sell WHERE chek = '$id'");
    $result->execute();
    return $result;
}

function getFood($con) {
    $result = $con->query("SELECT * FROM food GROUP BY name_food");
    $result->execute();
    return $result->fetchAll();
}

function getIng($con) {
    $result = $con->query("SELECT * FROM ingredients GROUP BY name_ing");
    $result->execute();
    return $result->fetchAll();
}

function insertFood($con, $chek, $idFood, $idIng, $combined) {
    $result = $con->query("INSERT INTO sell (id_sell, chek, date, fk_id_food, fk_id_ing, combined, charged) VALUES (NULL, '$chek', CURRENT_TIMESTAMP, '$idFood', '$idIng', '$combined', '0')");
    return true;
}
?>

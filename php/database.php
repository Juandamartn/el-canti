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

function noOrder($con) {
    $result = $con->query("SELECT chek FROM sell GROUP BY chek");
    $result->execute();
    return $result->fetchAll();
}

function orderDetails($con, $i) {
    $result = $con->query("SELECT sell.chek, food.name_food, ingredients.name_ing, sell.combined, food.price, sell.deliver, sell.charged FROM sell INNER JOIN food ON sell.fk_id_food=food.id_food INNER JOIN ingredients ON ingredients.id_ing=sell.fk_id_ing WHERE sell.charged = '0' AND sell.chek = '$i'");
    $result->execute();
    return $result->fetchAll();
}

function isDelivery($con, $i) {
    $result = $con->query("SELECT deliver FROM sell WHERE chek = '$i' LIMIT 1");
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

function insertFood($con, $chek, $idFood, $idIng, $combined, $deliver) {
    $result = $con->query("INSERT INTO sell (id_sell, chek, date, fk_id_food, fk_id_ing, combined, deliver, charged) VALUES (NULL, '$chek', CURRENT_TIMESTAMP, '$idFood', '$idIng', '$combined', '$deliver', '0')");
    return true;
}

function lastOrder($con) {
    $result = $con->query("SELECT chek FROM sell WHERE charged = '0' GROUP BY chek DESC LIMIT 1");
    $result->execute();
    return $result->fetchAll();
}

function insertSale($con, $chek, $total) {
    $result = $con->query("INSERT INTO sales (id_sales, chek, date, total) VALUES (NULL, '$chek', CURRENT_TIMESTAMP, '$total')");
    return true;
}

function chargeOrder($con, $chek) {
    $result = $con->query("UPDATE sell SET charged = '1' WHERE chek = '$chek'");
    return true;
}
?>

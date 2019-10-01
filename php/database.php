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
    $result = $con->query("SELECT sell.chek, food.name_food, ingredients.name_ing, sell.combined, food.price, sell.charged FROM sell INNER JOIN food ON sell.fk_id_food=food.id_food INNER JOIN ingredients ON ingredients.id_ing=food.fk_id_ing WHERE charged = '0' AND chek = '$chek'");
    $result->execute();
    return $result->fetchAll();
}

function orderCount($con) {
    $result = $con->query("SELECT chek, charged FROM sell GROUP BY chek");
    $result->execute();
    return $result->fetchAll();
}
?>

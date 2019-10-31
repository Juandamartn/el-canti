<?php
$noOrder = noOrder($con);
$total = 0;  
$current = lastOrder($con);

if ($current == false) {
    $current = 1;
} else {
    $current = $current[0]['chek'] + 1;
}
?>

<?php foreach($noOrder as $num): ?>

<div class="report on" id="report">
    <h1><?php $del = isDelivery($con, $num['chek']); foreach ($del as $deliv): if ($deliv['deliver'] == 0) {?>Cuenta <?php } else {?>Para llevar <?php } endforeach; ?><?php print_r($num['chek']); ?></h1>

    <?php $orders = orderDetails($con, $num['chek']); foreach($orders as $order): ?>

    <ul>
        <?php if($order['combined'] == 0) { ?>

        <li class="foodList"><?php print_r($order['name_food'].' '.$order['name_ing']); ?></li>

        <?php } else { ?>

        <li class="foodList"><?php
        print_r($order['name_food'].' '.$order['name_ing'].' COMBINADO');
        $total += 5;
        ?></li>

        <?php } ?>
    </ul>

    <?php
    $total += $order['price'];
    endforeach;
    ?>

    <h2 class="total" id="total<?php echo $num['chek']; ?>"><?php echo '$ '.$total; $total = 0; ?></h2>

    <div class="sell-buttons">
        <button class="chek" id="chek" onclick="chargeOrder(this)" data-id="<?php echo $num['chek']; ?>">
            <i class="fas fa-dollar-sign"></i>
        </button>

        <a class="cancel" id="cancel" href="index.php?view=home&id=<?php echo $num['chek']; ?>&display=1">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>

<?php endforeach; ?>

<div class="report">
    <a class="newOrder" id="newOrder" href="index.php?view=home&displayF=1">
        <i class="far fa-plus-square"></i>
    </a>
</div>

<div class="modal" id="modal" <?php if ($_GET['displayF'] == false) {  } else if ($_GET['displayF'] == 1) {
    echo 'style="display: block"';
} else if ($_GET['displayF'] == 0) {
    echo 'style="display: none"';
} ?>>
    <div class="setOrder" id="setOrder">
        <div class="containerOrder" id="containerOrders">
            <div class="selectFood" id="selectFood">
                <?php $foods = getFood($con); foreach($foods as $food): ?>

                <div class="food" ondblclick="addItem('<?php print_r($food['name_food']); ?>', '<?php print_r($food['id_food']); ?>')">
                    <p><?php print_r($food['name_food']); ?></p>

                    <img src="svg/<?php $nameFood = str_replace(' ', '', $food['name_food']); echo $nameFood; ?>.svg" alt="">
                </div>

                <?php endforeach; ?>
            </div>

            <div class="selectIng" id="selectIng">
                <?php $ings = getIng($con); foreach($ings as $ing): ?>

                <div class="ing" ondblclick="addItemIng('<?php print_r($ing['name_ing']); ?>', '<?php print_r($ing['id_ing']); ?>')">
                    <p><?php print_r($ing['name_ing']); ?></p>

                    <img src="svg/<?php $nameIng = str_replace(' ', '', $ing['name_ing']); echo $nameIng; ?>.svg" alt="">
                </div>

                <?php endforeach; ?>
            </div>

            <form action="php/insertOrder.php" method="POST" class="orderList" id="orderList">
                <input type="text" name="idOrder" value="<?php echo $current; ?>" class="hidden" readonly>

                <input type="checkbox" name="deliver" id="deliverCheck">

                <label for="deliverCheck" class="deliverCheckS"><span></span>Pedido para llevar</label>
            </form>
        </div>

        <div class="options">
            <button class="yes" id="acept-deliver" onclick="accept()">
                <i class="fas fa-check"></i>
            </button>

            <a class="no" id="no" href="index.php?view=home&displayF=0">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </div>

    <div class="warning" id="warning">
        <i class="fas fa-exclamation-circle"></i>

        <p>No ha ingresado alimentos</p>

        <button class="noItem" id="noItem" onclick="closeDeliver()">Aceptar</button>
    </div>

    <div class="charge hidden" id="charge">
        <div class="charge01" id="charge01">
            <p class="totalCharge" id="totalCharge"></p>
            <label for="money">Efectivo: </label>
            <input type="text" class="money" id="money" name="money" onkeyup="subtraction(this.value)" autofocus>
            <p class="exchange" id="exchange">Cambio:</p>
        </div>

        <div class="options">
            <button class="yes" id="chargeYes" onclick="chargeO()">
                <i class="fas fa-check"></i>
            </button>

            <button class="no" id="no" onclick="closeForm(this)">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<div class="modal1" id="modal1" <?php if (isset($_GET['id']) && $_GET['display'] == 1) {
    echo 'style="display: block"';
} else if ($_GET['display'] == 0) {
    echo 'style="display: none"';
} ?>>
    <div class="deleteOrder" id="deleteOrder">
        <h2>¿Está seguro que desea eliminar la cuenta?</h2>

        <div class="options">
            <a class="yes" id="yes" href="php/deleteOrder.php?id=<?php echo $_GET['id']; ?>">
                <i class="fas fa-check"></i>
            </a>

            <a class="no" id="no" href="index.php?view=home&display=0">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </div>
</div>

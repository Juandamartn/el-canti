<?php
$current = 1;

for($i = 1; $i < $countLength + 1; $i++) {
    $orders = orders($i, $con);
    $total = 0;
    $current += 1;
    
    if (empty($orders)) {} else {
?>

<div class="report on" id="report">
    <h1>Cuenta <?php echo $i; ?></h1>

    <?php foreach($orders as $order): ?>

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

    <h2 class="total"><?php echo '$ '.$total; ?></h2>

    <div class="sell-buttons">
        <a class="chek" id="chek">
            <i class="fas fa-dollar-sign"></i>
        </a>

        <a class="cancel" id="cancel" href="index.php?view=home&id=<?php echo $i; ?>&display=1">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>

<?php }} ?>

<div class="report">
    <a class="newOrder" id="newOrder" href="index.php?view=home&displayF=1">
        <i class="far fa-plus-square"></i>
    </a>
</div>

<div class="modal" id="modal" <?php if ($_GET['displayF'] == 1) {
    echo 'style="display: block"';
} else if ($_GET['displayF'] == 0) {
    echo 'style="display: none"';
} ?>>
    <div class="setOrder" id="setOrder">
        <div class="containerOrder" id="containerOrders">
            <div class="selectFood" id="selectFood">
                <?php $foods = getFood($con); foreach($foods as $food): ?>

                <div class="food" ondblclick="addItem('<?php print_r($food['name_food']); ?>', '<?php print_r($food['id_food']); ?>')"><?php print_r($food['name_food']); ?></div>
                
                <?php endforeach; ?>
            </div>

            <div class="selectIng" id="selectIng">
                <?php $ings = getIng($con); foreach($ings as $ing): ?>

                <div class="ing" ondblclick="addItemIng('<?php print_r($ing['name_ing']); ?>', '<?php print_r($ing['id_ing']); ?>')"><?php print_r($ing['name_ing']); ?></div>
                
                <?php endforeach; ?>
            </div>

            <form action="php/insertOrder.php" method="POST" class="orderList" id="orderList">
            <input type="text" name="idOrder" value="<?php echo $current; ?>" class="hidden" readonly>
            </form>
        </div>

        <div class="options">
            <button type="submit" class="yes" id="yes" form="orderList">
                <i class="fas fa-check"></i>
            </button>

            <a class="no" id="no" href="index.php?view=home&displayF=0">
                <i class="fas fa-times"></i>
            </a>
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
            <a class="yes" id="yes" href="php/deleteOrder.php?id=<?php echo $_GET['id'] ?>">
                <i class="fas fa-check"></i>
            </a>

            <a class="no" id="no" href="index.php?view=home&display=0">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </div>
</div>

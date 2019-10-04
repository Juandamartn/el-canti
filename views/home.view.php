<?php
for($i = 1; $i < $countLength + 1; $i++) {
    $orders = orders($i, $con);
    $total = 0;
    
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
    <div class="newOrder" id="newOrder">
        <i class="far fa-plus-square"></i>
    </div>
</div>

<div class="modal" id="modal">
    <div class="setOrder" id="setOrder">

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

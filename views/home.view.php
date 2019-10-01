<?php
for($i = 1; $i < $countLength + 1; $i++) {
    $orders = orders($i, $con);
    $total = 0;
?>

<div class="report on">
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
        <div class="chek" id="chek">
            <i class="fas fa-dollar-sign"></i>
        </div>

        <div class="cancel" id="cancel">
            <i class="fas fa-times"></i>
        </div>
    </div>
</div>

<?php } ?>

<div class="report">
    <div class="newOrder" id="newOrder">
        <i class="far fa-plus-square"></i>
    </div>
</div>

<div class="setOrder" id="setOrder">

</div>

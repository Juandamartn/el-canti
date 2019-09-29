<?php
for($i = 1; $i < $countLength + 1; $i++) {
    $orders = orders($i, $con);
    $total = 0;
?>

<div class="report on">
    <h1>Cuenta <?php echo $i; ?></h1>

    <?php foreach($orders as $order): ?>

    <ul>
        <li><?php print_r($order['name_food'].' '.$order['name_ing']); ?></li>
    </ul>

    <?php
    $total += $order['price'];
    endforeach;
    ?>
    
    <h2 class="total"><?php echo $total; ?></h2>
</div>

<?php } ?>

<div class="report">
    <button class="newOrder">
        <i class="far fa-plus-square"></i>
    </button>
</div>

<div class="setOrder" id="setOrder">

</div>

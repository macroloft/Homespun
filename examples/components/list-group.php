<?php

$items = $_val('items') ?? null;

?>
<div class="list-group">
    <?php foreach ($items as $item) : ?>
        <div class="list-group-item"><?= $item ?></div>
    <?php endforeach ?>
</div>

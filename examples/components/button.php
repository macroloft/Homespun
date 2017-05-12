<?php

$attrs = ['class', 'id|val', 'type|val', 'data', 'disabled|val', 'onclick|val'];
$context = $_isset('context', 'btn-%s', 'btn-default');
$icon = $_isset('icon', '<span class="glyphicon glyphicon-%s');

$_prepare('class', 'btn', $context);
$_prepare('type', 'button');

$label = $_val('label') ?? 'Default Label'; // isset ? $useProp : 'Set fallback'

?>

<button <?= $_attr(...$attrs) ?>>
    <?= $icon ?>
    <?= $label ?>
</button>

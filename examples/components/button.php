<?php

$attrs = ['class', 'id|val', 'type|val', 'data', 'disabled|val', 'onclick|val'];
$context = $_isset('context', 'btn-%s', 'btn-default');

$_prepare('class', 'btn', $context);
$_prepare('type', 'button');

$label = $_val('label') ?? 'Default Label'; // isset ? $useProp : 'Set fallback'

?>

<div style="margin-top: 20px; padding: 20px; background-color: #ddd;">
    <button <?= $_attr(...$attrs) ?>>
        <?= $label ?>
    </button>
</div>

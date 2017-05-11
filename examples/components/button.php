<?php

$attrs = ['class', 'id|prop', 'type|prop', 'data', 'disabled|prop', 'onclick|prop'];
$context = $_isset('context', 'btn-%s', 'btn-default');

$_prepare('class', 'btn', $context);
$_prepare('type', 'button');

$label = $_prop('label') ?? 'Default Label'; // isset ? $useProp : 'Set fallback'

?>

<div style="margin-top: 20px; padding: 20px; background-color: #ddd;">
    <button <?= $_attr(...$attrs) ?>>
        <?= $label ?>
    </button>
</div>

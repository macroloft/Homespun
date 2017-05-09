<?php

$attrs = ['class', 'id|prop', 'type|prop', 'onclick|prop'];

$_prepare('class', 'btn', 'btn-default');
$_prepare('type', 'button');

$label = $_prop('label') ?? 'Default Label'; // isset ? $useProp : 'Set fallback'

?>

<div style="margin-top: 20px; padding: 20px; background-color: #ddd;">
    <button <?= $_attr(...$attrs) ?>>
        <?= $label ?>
    </button>
</div>

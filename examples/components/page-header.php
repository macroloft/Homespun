<?php

$label = $_val('label') ?? 'Page';
$sub = $_isset('sub', ' <small>%s</small>');

?>
<div class="page-header">
    <h1><?= $label . $sub ?></h1>
</div>

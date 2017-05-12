<?php

$label   = $_val('label')  ?? 'My Panel';
$body    = $_val('body')   ?? 'Hot contents&hellip;';
$footer  = $_val('footer') ?? null;

$context = $_isset('context', 'panel-%s', 'panel-default');

$_prepare('class', 'panel', $context);

?>
<div <?= $_attr('class', 'id|val', 'data') ?>>
    <div class="panel-heading">
        <div class="panel-title"><?= $label ?></div>
    </div>
    <div class="panel-body">
        <?= $body ?>
    </div>
    <?php if ($footer) : ?>
        <div class="panel-footer">
            <?= $footer ?>
        </div>
    <?php endif ?>
</div>

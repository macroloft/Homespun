<?php
    $label = isset($label) ? $label : 'Foo';

    var_dump($this);
?>

<div style="margin-top: 20px; padding: 20px; background-color: #ddd;">
    <button type="button" id="<?= $_id ?>"><?= $label ?></button>
</div>

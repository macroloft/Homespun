<?php
    $label = $this->label() ?? 'Foo'; // isset ? $ : ''

    $this->class('btn', 'btn-default');

    var_dump($this);
?>

<div style="margin-top: 20px; padding: 20px; background-color: #ddd;">
    <button <?= $_attr('class', 'id') ?> type="button"><?= $label ?></button>
</div>

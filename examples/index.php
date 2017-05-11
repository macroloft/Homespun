<?php

require 'components.php';

$foo = Button('Bar');

?>

<?= $foo ?>

<?= Button('Bar')->label('Baz')->onclick("alert('foo')") ?>

<hr>

<?php foreach (Data() as $item) echo "<h3>$item</h3>"; ?>

<hr>

<?php
    $btn = Button()->class('foo', 'bar')->id('bum')->id('baz')->type('submit')->disabled(true)->data(['foo' => 'bar'], ['baz' => 'bang'])->context('primary');

    echo $btn;
?>

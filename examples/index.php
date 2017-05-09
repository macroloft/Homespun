<?php

require 'components.php';

$foo = Button('Bar');

?>

<pre style="background-color: #eee; padding: 20px;"><?= var_dump($foo) ?></pre>

<?= $foo ?>

<?= Button('Bar')->label('Baz')->onclick("alert('foo')") ?>

<hr>

<?php foreach (Data() as $item) echo "<h3>$item</h3>"; ?>

<hr>

<?= Button()->class('foo', 'bar')->id('bum')->id('baz')->type('submit') ?>

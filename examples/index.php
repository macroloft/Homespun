<?php

require '../src/Homespun.php';

function Button ( $payload = [] )
{
    $h = new \Homespun\Homespun('button', $payload);
    $h->setBasePath('./components/');
    return $h;
}

function Data ( $payload = [] )
{
    $h = new \Homespun\Homespun('data', $payload);
    $h->setBasePath('./components/');
    return $h->raw();
}

$foo = Button([
    'label' => 'Bar'
]);

?>

<pre style="background-color: #eee; padding: 20px;"><?= var_dump($foo) ?></pre>

<?= Button([
    'label' => 'Bar'
]) ?>

<?= $foo ?>

<h3>
<?= var_dump(Data()) ?>
</h3>

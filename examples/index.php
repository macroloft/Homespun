<?php

require 'vendor/autoload.php';
require 'components.php';

$foo = Button('Bar');
$btn = Button()->class('foo', 'bar')->id('bum')->id('baz')->type('submit')->disabled(true)->data(['foo' => 'bar'], ['baz' => 'bang'])->context('primary');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Homespun Example Page</title>
        <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">

            <?= PageHeader('Homespun')
                ->sub('Extend recurring HTML snippets to reusable components') ?>

            <?= Panel('For example some cool buttons')
                ->context('primary')
                ->body(
                    $foo
                    . Button('Bar')->label('Baz')->onclick("alert('foo')")
                    . $btn
                    . Button('Danger')->context('danger')
                )
                ->footer('&hellip;in a panel!')
            ?>

            <?= Tabs(Db('tabs')) ?>

            <?= ListGroup(Db('data')) ?>

            <?= ListGroup(['Direct', 'Input']) ?>
        </div>

        <script src="vendor/components/jquery/jquery.min.js"></script>
        <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

    </body>
</html>


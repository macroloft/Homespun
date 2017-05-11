<?php

require '../src/Homespun.php';

function Button ( $label = null )
{
    $h = new \Homespun\Homespun('button');
    $h->setBasePath('./components/');
    return $h->label($label);
}

function Data ( $payload = [] )
{
    $h = new \Homespun\Homespun('data', $payload);
    $h->setBasePath('./components/');
    return $h->raw();
}

?>

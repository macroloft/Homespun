<?php

function Button ( $label = null )
{
    $h = new \Homespun\Homespun('button');
    $h->setBasePath('./components/');
    return $h->label($label);
}

function ListGroup ( $items = null )
{
    $h = new \Homespun\Homespun('list-group');
    $h->setBasePath('./components/');
    return $h->items($items);
}

function PageHeader ( $label = null )
{
    $h = new \Homespun\Homespun('page-header');
    $h->setBasePath('./components/');
    return $h->label($label);
}

function Panel ( $label = null )
{
    $h = new \Homespun\Homespun('panel');
    $h->setBasePath('./components/');
    return $h->label($label);
}

function Tabs ( $tabs = null )
{
    $h = new \Homespun\Homespun('tabs');
    $h->setBasePath('./components/');
    return $h->tabs($tabs);
}

function Db ( $target )
{
    $h = new \Homespun\Homespun($target);
    $h->setBasePath('./data/');
    return $h->raw();
}

?>

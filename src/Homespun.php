<?php
namespace Homespun;

class Homespun
{
    protected $_basePath = './',
              $_targetPath = '',
              $_path = '',
              $_data = [],
              $_raw = false;

    function __construct ( $component )
    {
        $this->_targetPath = $component;
        $this->_prepareData();
        return $this;
    }

    function __toString ()
    {
        return $this->_render();
    }

    function __call ( $name, $args )
    {
        if ( !empty($args) )
        {
            if ( isset($this->_data[$name]) )
                array_push($this->_data[$name], ...$args);
            else
            {
                $this->_data[$name] = $args;
                $this->_sortData();
            }
            return $this;
        }
        else if ( array_key_exists($name, $this->_data) )
            return $this->_data[$name];
        else
            return null;
    }

    function raw ()
    {
        $this->_raw = true;
        return $this->_render();
    }

    function setBasePath ( $path )
    {
        $this->_basePath = $path;
        return $this;
    }

    protected function _prepareData ()
    {
        $this->_data = array_merge(
            [
                '_id' => '_' . uniqid(),
                '_path_base' => $this->_basePath,
                '_path_target' => $this->_targetPath,
                '_path' => $this->_path,
            ],
            $this->_data
        );

        $this->_sortData();

        return $this;
    }

    protected function _sortData () {
        ksort($this->_data);
        return $this;
    }

    protected function _preparePath ()
    {
        $this->_path = $this->_basePath . $this->_targetPath . '.php';
    }

    protected function _render ()
    {
        $this->_preparePath();

        $_attr = function ( ...$names ) {
            return $this->attr(...$names);
        };

        $_prop = function ($name) {
            return $this->prop($name);
        };

        $_props = function ( $name = null ) {
            return $this->props($name);
        };

        $_prepend = function ( $name, ...$payload ) {
            return $this->prepend($name, ...$payload);
        };

        $_prepare = $_prepend;

        $_append = function ( $name, ...$payload ) {
            return $this->append($name, ...$payload);
        };

        if ( $this->_raw )
            return require $this->_path;

        ob_start();
        require $this->_path;
        return ob_get_clean() . PHP_EOL;
    }

    /**
     * Helpers
     * Public for debugging and flexibility
    */

    // returns data as html attribute
    function attr ( ...$names ) {
        $output = [];

        foreach ( $names as $name ) {
            $_name = explode('|', $name);
            $mode = $_name[1] ?? 'props';

            if ( $value = $this->{$mode}($_name[0]) )
                $output[] = $_name[0] . '="' . (is_array($value) ? implode(' ', $value) : $value) . '"';
        }

        return implode(' ', $output);
    }

    // returns latest value in data-key
    function prop ( $name ) {
        if ( array_key_exists($name, $this->_data) )
            return array_values(array_slice($this->_data[$name], -1))[0];
        else
            return null;
    }

    // returns values of data-key or complete data
    function props ( $name = null ) {
        if ( is_null($name) )
            return $this->_data;
        if ( array_key_exists($name, $this->_data) )
            return $this->_data[$name];
        else
            return null;
    }

    // prepend to data-prop
    function prepend ( $name, ...$payload )
    {
        if ( !empty($payload) )
        {
            if ( array_key_exists($name, $this->_data) )
                array_unshift($this->_data[$name], ...$payload);
            else
                $this->_data[$name] = $payload;
        }
        return $this;
    }

    // append to data-prop
    function append ( $name, ...$payload )
    {
        if ( !empty($payload) )
        {
            if ( array_key_exists($name, $this->_data) )
                array_push($this->_data[$name], ...$payload);
            else
                $this->_data[$name] = $payload;
        }

        return $this;
    }
}

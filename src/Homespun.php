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
        // set
        if ( !empty($args) )
        {
            // extend existing property
            if ( isset($this->_data[$name]) )
                array_push($this->_data[$name], ...$args);
            // create new property
            else
            {
                $this->_data[$name] = $args;
                $this->_sortData();
            }
            return $this;
        }
        // get
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

    // adds useful properties and merges into userprops
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

    // cosmetics: sort data properties
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

        $_prepare = $_prepend; // alias

        $_append = function ( $name, ...$payload ) {
            return $this->append($name, ...$payload);
        };

        $_isset = function (...$payload) {
            return $this->isset(...$payload);
        };

        if ( $this->_raw )
            return require $this->_path;

        ob_start();
        require $this->_path;
        return ob_get_clean() . PHP_EOL;
    }

    // processes data-props and returns array of property => value pairs
    protected function _propsToAttrArray ( $key, $values )
    {
        // definitive values do not come as array
        if ( !is_array($values) )
            return [$key => $values];

        $return = [];

        foreach ( $values as $value )
        {
            if ( is_bool($value) || is_numeric($value) )
            {
                $return[$key] = $value;
            }
            else if ( is_string($value) )
            {
                // shortening: if one value is a string all coming shound be strings too
                $return[$key] = implode(' ', $values);
                break;
            }
            else if ( count(array_filter(array_keys($value), 'is_string')) )
            {
                // for attributes with prefix like data, aria...
                foreach ($value as $subkey => $val)
                    $return["$key-$subkey"] = $val;
            }
        }

        return $return;
    }

    // converts array of property => value pairs into html5 attributes and returns as string
    protected function _arrayToAttrs ( $array )
    {
        $attributes = array_map (
            function ($key, $value) {
                if ( is_bool($value) && $value )
                    return $key;
                else
                    return sprintf('%s="%s"', $key, $value);
            }, array_keys($array), $array
        );

        return implode(' ', $attributes);
    }

    /**
     * Helpers
     * Public for debugging and flexibility
    */


    // returns data as html attribute
    function attr ( ...$names )
    {
        $attrArray = [];

        foreach ( $names as $name ) {
            $_name = explode('|', $name);

            // decide if definitive/single or multiple props
            $key = $_name[0];
            $mode = $_name[1] ?? 'props';

            if ( $value = $this->{$mode}($key) )
                $attrArray = array_merge($attrArray, $this->_propsToAttrArray( $key, $value ));
        }

        return $this->_arrayToAttrs($attrArray);
    }

    // returns latest value in data-key
    function prop ( $name )
    {
        if ( array_key_exists($name, $this->_data) )
            return array_values(array_slice($this->_data[$name], -1))[0];
        else
            return null;
    }

    // returns values of data-key or complete data
    function props ( $name = null )
    {
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

    // check if prop isset, return true, false or custom string
    function isset ( $name, $true = null, $false = null )
    {
        $value = $this->prop($name);

        if ( $value && $true )
            return sprintf($true, $value);
        else if ( $value )
            return true;
        else if ( $false )
            return $false;
        else
            return false;
    }
}

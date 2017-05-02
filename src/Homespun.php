<?php
namespace Homespun;

class Homespun
{
    protected $_basePath = './',
              $_targetPath = '',
              $_path = '',
              $_data = [],
              $_raw = false;

    function __construct ( $component, $payload = [] )
    {
        $this->_targetPath = $component;
        $this->_data = $payload;

        $this->_prepareData();

        return $this;
    }

    function __toString ()
    {
        return $this->_render();
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

        $_data = $this->_data;

        foreach ( $_data as $key => $value )
            ${$key} = $value;

        if ( $this->_raw )
            return require $this->_path;

        ob_start();
        require $this->_path;
        return ob_get_clean() . PHP_EOL;
    }
}

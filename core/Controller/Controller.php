<?php

namespace Core\Controller;

use App;

class Controller
{
    protected $sViewPath = APP_PATH . '/Views';
    protected $sTemplate = 'default';
    protected $sError404;

    public function __construct()
    {

    }

    /**
     * Render a view
     * @param string $sView
     * @param array $aData
     */
    protected function render( $sView, $aData = array() )
    {
        ob_start();
        extract( $aData );
        require( $this->sViewPath . '/' . $sView . '.php' );
        $sContent = ob_get_clean();
        require( $this->sViewPath . '/templates/' . $this->sTemplate . '.php' );
    }

    /**
     * Load a model
     * @param $sModelName
     */
    protected function loadModel( $sModelName )
    {
        $sModelName .= 'Model';
        $this->$sModelName = App::getApp()->getModel( $sModelName );
    }

    /**
     * Getter $sTemplate
     * @return string
     */
    public function getTemplate()
    {
        return $this->sTemplate;
    }

    /**
     * Setter $sTemplate
     * @param string $sTemplate
     */
    public function setTemplate( $sTemplate )
    {
        $this->sTemplate = $sTemplate;
    }

    /**
     * Error 404 not found
     */
    protected function notFound()
    {
        $sError404 = \Core\Config::getConfig()->get( 'error_404' );
        header( 'HTTP/1.O 404 Not Found' );
        header( 'Location: ' . $sError404 );
    }


}
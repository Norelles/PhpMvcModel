<?php

namespace Core;

class Config
{

    protected $aSettings = array();
    
    protected static $oConfig;

    public function __construct( $sFile )
    {
        $this->aSettings = require( $sFile );
    }
    
    public static function getConfig()
    {
        if ( self::$oConfig == null ) {
            self::$oConfig = new Config( CONFIG_PATH . '/config.php' );
        }
        return self::$oConfig;
    }

    public function get( $sKey )
    {
        if ( ! isset( $this->aSettings[ $sKey ] ) ) {
            return null;
        }
        return $this->aSettings[ $sKey ];
    }

}
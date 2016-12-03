<?php

use Core\Config;
use Core\Database\MysqlDatabase;

class App
{
    protected static $oApp;
    protected $oDb;
    protected $sTitle;

    public static function getApp()
    {
        if ( self::$oApp == null ) {
            self::$oApp = new App();
        }
        return self::$oApp;
    }

    public static function load()
    {
        session_start();
        // Autoloader App
        require APP_PATH . '/Autoloader.php';
        App\Autoloader::register();
        // Autoloader Core
        require CORE_PATH . '/Autoloader.php';
        Core\Autoloader::register();
    }

    public function getTitle()
    {
        if ( ! isset( $this->sTitle ) ) {
            $this->setTitle( Config::getConfig()->get( 'default_title' ) );
        }
        return $this->sTitle;
    }

    public function setTitle( $sTitle )
    {
        $this->sTitle = $sTitle;
    }


    public function getModel( $sName )
    {
        $sClassName = '\\App\\Models\\' .  ucfirst( $sName );
        return new $sClassName( $this->getDb() );
    }

    public function getDb()
    {
        $oConfig = Config::getConfig();
        if ( $this->oDb == null ) {
            $this->oDb = new MysqlDatabase(
                $oConfig->get( 'db_name' ),
                $oConfig->get( 'db_user' ),
                $oConfig->get( 'db_password' ),
                $oConfig->get( 'db_host' )
            );
        }
        return $this->oDb;
    }




}
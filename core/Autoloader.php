<?php

namespace Core;

class Autoloader
{
    /**
     * Register autoloader
     */
    static function register()
    {
        spl_autoload_register( array( __CLASS__, 'autoload' ) );
    }

    /**
     * Require needed classes
     * @param {string} $sClassName
     */
    static function autoload( $sClassName )
    {
        if ( strpos( $sClassName, __NAMESPACE__ . '\\' ) === 0 ) {
            $sClassName = str_replace( __NAMESPACE__ . '\\', '', $sClassName );
            $sClassName = str_replace( '\\', '/', $sClassName );
            require  __DIR__ . '/' . $sClassName . '.php';
        }
    }
}
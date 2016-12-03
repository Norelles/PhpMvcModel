<?php

define( 'ROOT_PATH', dirname( __DIR__ ) );
define( 'APP_PATH', ROOT_PATH . '/app' );
define( 'VIEW_PATH', APP_PATH . '/Views' );
define( 'CORE_PATH', ROOT_PATH . '/core' );
define( 'CONFIG_PATH', ROOT_PATH . '/config' );

require ROOT_PATH . '/app/App.php';
App::load();

define( 'BASE_URL', \Core\Config::getConfig()->get( 'base_url' ) );
define( 'IMG_URL', BASE_URL . '/img' );
define( 'CSS_URL', BASE_URL . '/css' );
define( 'JS_URL', BASE_URL . '/js' );
define( 'PDF_URL', BASE_URL . '/pdf' );

$router = new \Core\Router\Router($_SERVER['REQUEST_URI']);
$router->get( '/', function() {
    $oController = new \App\Controllers\PostController();
    $oController->index();
} );
$router->get( '/post/:id', function( $sId ) {
    $oController = new \App\Controllers\PostController();
    $oController->single( $sId );
} );
$router->get( '/category/:id', function( $sId ) {
    $oController = new \App\Controllers\PostController();
    $oController->category( $sId );
} );
$router->get( '/login', function() {
    $oController = new \App\Controllers\UserController();
    $oController->login();
} );

try {
    $router->run();
} catch ( Exception $e ) {
    header( 'Location: ' . BASE_URL );
}
<?php

namespace App\Controllers;

use Core\Controller\Controller;
use App;

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadModel( 'post' );
        $this->loadModel( 'category' );

        $oPosts = $this->postModel->getLast();
        $oCategories = $this->categoryModel->fetchAll();

        $aData = array(
            'oPosts' => $oPosts,
            'oCategories' => $oCategories
        );
        $this->render( 'post/index', $aData );
    }
    
    public function category( $sId )
    {
        $this->loadModel( 'post' );
        $this->loadModel( 'category' );

        $oCategory = $this->categoryModel->find( $sId );
        if ( $oCategory == false ) {
            $this->notFound();
        }
        $oPosts = $this->postModel->getLastByCategory( $sId );
        $oCategories = $this->categoryModel->fetchAll();

        $aData = array(
            'oPosts' => $oPosts,
            'oCategories' => $oCategories,
            'oCategory' => $oCategory
        );
        $this->render( 'post/category', $aData );
    }
    
    public function single( $sId )
    {
        $this->loadModel( 'post' );
        $this->loadModel( 'category' );

        $oPost = $this->postModel->find( $sId );

        if ( $oPost === false ) {
            $this->notFound();
        }
        $oApp = App::getApp();
        $oApp->setTitle( $oPost->title );

        $oCategory = $this->categoryModel->find( $oPost->id_category );

        $aData = array(
            'oPost' => $oPost,
            'oCategory' => $oCategory
        );
        $this->render( 'post/single', $aData );
    }
}
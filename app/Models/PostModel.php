<?php
namespace App\Models;

use Core\Model\Model;

class PostModel extends Model
{
    
    protected $sTable = 'post';
    
    /**
     * Récupère les derniers articles
     * @return array
     */
    public function getLast()
    {
        return $this->query( "
            SELECT p.id, p.title, p.content, c.title as category
            FROM post p
            LEFT JOIN category c on p.id_category = c.id
            ORDER BY p.date DESC
         " );
    }

    /**
     * Récupère les derniers articles d'une categorie
     * @param $iCategoryId
     * @return \App\Entities\PostEntity
     */
    public function getLastByCategory( $iCategoryId )
    {
        return $this->query( "
            SELECT p.id, p.title, p.content, c.title as category
            FROM post p
            LEFT JOIN category c on p.id_category = c.id
            WHERE p.id_category = ?
            ORDER BY p.date DESC
         ", array( $iCategoryId ) );
    }
}
<?php

namespace Core\Model;

use Core\Database\Database;

class Model
{
    protected $sTable;
    protected $oDb;
    
    public function __construct( Database $oDb )
    {
        $this->oDb = $oDb;
        if ( $this->sTable == null ) {
            $aParts = explode( '\\', get_class( $this ) );
            $sClassName = end( $aParts );
            $this->sTable = strtolower( str_replace( 'Models', '', $sClassName ) );
        }
    }

    protected function getTable()
    {
        return $this->sTable;
    }

    public function query( $sStatement, $aParams = array(), $bOne = false )
    {
        $sClassName = get_class( $this );
        $sEntityName = str_replace( 'Model', 'Entity', str_replace( 'Models', 'Entities', $sClassName ) );
        if ( isset( $aParams ) ) {
            return $this->oDb->prepare( $sStatement, $aParams, $sEntityName, $bOne );
        } else {
            return $this->oDb->query( $sStatement, $sEntityName, $bOne );
        }
    }

    public function fetchAll()
    {
        return $this->query( '
            SELECT *
            FROM ' . $this->getTable() . '
        ' );
    }
    
    public function find( $iId )
    {
        return $this->query( '
            SELECT *
            FROM ' . $this->getTable() . '
            WHERE id = ?
        ', array( $iId ), true );
    }



}
<?php

namespace Core\Database;
use \PDO;

class MysqlDatabase extends Database
{
    protected $oPdo;

    protected $sDbName;
    protected $sDbUser;
    protected $sDbPassword;
    protected $sDbHost;

    public function __construct( $sDbName, $sDbUser = 'root', $sDbPassword = 'root', $sDbHost = 'localhost' )
    {
        $this->sDbName = $sDbName;
        $this->sDbUser = $sDbUser;
        $this->sDbPassword = $sDbPassword;
        $this->sDbHost = $sDbHost;
    }

    protected function getPDO()
    {
        if ( $this->oPdo === null ) {
            $oPdo = new PDO( 'mysql:dbname=' . $this->sDbName . ';host=' . $this->sDbHost, $this->sDbUser, $this->sDbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') );
            $oPdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->oPdo = $oPdo;
        }
        return $this->oPdo;
    }

    public function query( $sQuery, $sClassName = null, $bOne = false )
    {
        $oQuery = $this->getPDO()->query( $sQuery );
        if ( $sClassName == null ) {
            $oQuery->setFetchMode( PDO::FETCH_OBJ );
        } else {
            $oQuery->setFetchMode( PDO::FETCH_CLASS, $sClassName );
        }
        if ( $bOne ) {
            $oData = $oQuery->fetch();
        } else {
            $oData = $oQuery->fetchAll();
        }
        return $oData;
    }

    public function prepare( $sQuery, $aParams = array(), $sClassName = null, $bOne = false )
    {
        $oQuery = $this->getPDO()->prepare( $sQuery );
        $oQuery->execute( $aParams );
        $oQuery->setFetchMode( PDO::FETCH_CLASS, $sClassName );
        if ( $bOne ) {
            $oData = $oQuery->fetch();
        } else {
            $oData = $oQuery->fetchAll();
        }
        return $oData;
    }
}
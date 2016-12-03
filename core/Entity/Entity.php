<?php

namespace Core\Entity;

class Entity
{
    public function __get( $sKey )
    {
        $sMethod = 'get' . ucfirst( $sKey );
        $this->$sKey = $this->$sMethod();
        return $this->$sKey;
    }

}
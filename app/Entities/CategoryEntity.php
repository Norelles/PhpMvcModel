<?php

namespace App\Entities;

use Core\Entity\Entity;

class CategoryEntity extends Entity
{
    public function getUrl()
    {
        return 'category/id/' . $this->id;
    }
}
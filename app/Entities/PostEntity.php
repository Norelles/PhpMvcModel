<?php

namespace App\Entities;

use Core\Entity\Entity;

class PostEntity extends Entity
{
    public function getUrl()
    {
        return '/post/id/' . $this->id;
    }

    public function getResume()
    {
        $sHtml = '<p>' . substr( $this->content, 0, 50 ) . '...' . '</p>';
        $sHtml .= '<p><a href="' . $this->getURL() . '">Read more</a></p>';
        return $sHtml;
    }
}
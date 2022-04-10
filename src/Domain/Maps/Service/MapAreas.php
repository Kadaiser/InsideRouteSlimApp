<?php

namespace App\Domain\Maps\Service;

use App\Domain\Database\Service\MapDatabase;
use Selective\BasePath\BasePathMiddleware;

/**
 * Service.
 */
final class MapAreas
{
    private $image;
    private $areas;

    public function __construct(String $mapIdentifier = "")
    {
        $this->image = "map$mapIdentifier.png";
        $this->areas = array();
    }

    public function getImage(){
        return $this->image;
    }

    public function getAreas(){
        return $this->areas;
    }
    
}
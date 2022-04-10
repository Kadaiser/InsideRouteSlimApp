<?php

namespace App\Action;

use Slim\Views\PhpRenderer;
use pdo;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Domain\Maps\Service\MapAreas;
use App\Domain\Database\Service\MapDatabase;

final class MapDisplay
{
    private $map;
    
    public function __construct(String $mapIdentificator = '2')
    {
        $this->map = new MapAreas($mapIdentificator);
    }

    public function renderMap( ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $renderer = new PhpRenderer('../templates');
        
        $data["map"] = $this->map->getImage();
        $data["areas"] = $this->map->getAreas();
        $data["floor"] = $args["floor"];

        return $renderer->render($response, "MapDisplay.phtml", $data);
    }

    public function getAreas( ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $name = "map".$args["floor"];

        try {
            $db = new MapDatabase();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT * FROM maps WHERE name = :name");
            $stmt->execute(array(':name' => $name));
            $map = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
           
            $response->getBody()->write(json_encode($map));
            return $response
              ->withHeader('content-type', 'application/json')
              ->withStatus(200);
          } catch (PDOException $e) {
            $error = array( "message" => $e->getMessage() );
            $response->getBody()->write(json_encode($error));
            return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus(500);
        }
    }
}
<?php

namespace App\Action;

use App\Domain\Mesh\Service\MeshStatus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class GetNodeAction
{

    private $MeshStatus;
    
    public function __construct(MeshStatus $MeshStatus)
    {
        $this->MeshStatus = $MeshStatus;
    }

    public function __invoke( ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {


        // Invoke the Domain with inputs and retain the result
        $nodeList = $this->MeshStatus->getNodeList();

        // Transform the result into the JSON representation
        $result = [
            'nodes' => $nodeList
        ];

        // Build the HTTP response
        //$response->getBody()->write((string)json_encode($result));
        return $response;

        //$response->getBody()->write('Hello Kada!');
        //return $response;

        //$response->getBody()->write(json_encode(['success' => true]));
        //return $response->withHeader('Content-Type', 'application/json');
    }
}
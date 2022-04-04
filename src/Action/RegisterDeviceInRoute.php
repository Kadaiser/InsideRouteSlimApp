<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

final class RegisterDeviceInRoute
{
   
    public function __construct()
    {

    }

    public function __invoke( ServerRequestInterface $request, ResponseInterface $response, $arg): ResponseInterface {
        $input = $request->getParsedBody();
        $destiny = $input['destiny'];

        $data = array('success' => true);
        $payload = json_encode($data);
        sleep(5);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
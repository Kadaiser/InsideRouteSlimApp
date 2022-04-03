<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class MqttSubscriber
{

    
    public function __construct()
    {

    }

    public function __invoke( ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        return $response;
    }
}
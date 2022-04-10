<?php

namespace App\Action;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class MainPage
{
   
    public function __construct()
    {

    }

    public function __invoke( ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "MainPage.phtml");
    }
}
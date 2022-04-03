<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$displayErrorDetails = true;
$app = AppFactory::create();

$app->addErrorMiddleware(false, true, true);

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello Kada");
    return $response;
});

$app->run();

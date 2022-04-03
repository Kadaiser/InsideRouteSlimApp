<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {

    //routing assets/resources
    $app->get('/images/{data}', function($request, $response, $args) {    
        $data = $args['data'];
        $dir = dirname(__DIR__)."/resources/Images/";
        $image = @file_get_contents($dir.$data);
       if($image === FALSE) {
           $handler = $this->notFoundHandler;
           return $handler($request, $response);    
        }
        $response->getBody()->write($image);
        return $response->withHeader('Content-Type', FILEINFO_MIME_TYPE);
    });
    

    $app->get('/RegisterDeviceInRoute', \App\Action\RegisterDevice::class);
    $app->get('/GetNodes', \App\Action\GetNodeAction::class);
    $app->get('/MqttSubscriber', \App\Action\MqttSubscriber::class);

    $app->post('/RegisterDeviceInRoute', \App\Action\RegisterDeviceInRoute::class);
};
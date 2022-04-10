<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    
    $app->get('/', \App\Action\MainPage::class);
    $app->get('/Map/{floor}', '\App\Action\MapDisplay:renderMap');
    $app->get('/MapAreas/{floor}', '\App\Action\MapDisplay:getAreas');
    $app->post('/RegisterDevice', \App\Action\RegisterDeviceInRoute::class);

    $app->get('/GetNodes', \App\Action\GetNodeAction::class);
    $app->get('/MqttSubscriber', \App\Action\MqttSubscriber::class);


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

    //routing css
    $app->get('/css/{data}', function($request, $response, $args) {    
        $data = $args['data'];
        $dir = dirname(__DIR__)."/resources/css/";
        $css = @file_get_contents($dir.$data);
        if($css === FALSE) {
            $handler = $this->notFoundHandler;
            return $handler($request, $response);    
        }
        $response->getBody()->write($css);
        return $response->withHeader('Content-Type', 'text/css');
    });

};
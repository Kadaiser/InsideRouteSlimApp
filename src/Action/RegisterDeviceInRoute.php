<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use App\Domain\Mqtt\Service\MqttPublish;

final class RegisterDeviceInRoute
{
    private $MqttPublish;
   
    public function __construct(MqttPublish $MqttPublish)
    {
        $this->MqttPublish = $MqttPublish;
    }

    public function __invoke( ServerRequestInterface $request, ResponseInterface $response, $arg): ResponseInterface
    {
        $input = $request->getParsedBody();
        $destiny = $input['destiny'];

        //$output=null;
        //$retval=null;
        //exec("sh /var/www/html/scritps/bleNearestMac.sh", $output, $retval);
        //print_r($output);
        //print_r($retval);

        sleep(15);
        $mac = file_get_contents("/var/www/html/scritps/mac");
        $mac = strtolower(str_replace(array("\n", "\r"), '', $mac));
        $this->MqttPublish->publishRouteForMac($mac, $destiny);
        //print_r($mac);
        $data = array('success' => true, 'mac' => $mac);
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}
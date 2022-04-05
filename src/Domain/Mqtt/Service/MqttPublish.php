<?php

namespace App\Domain\Mqtt\Service;

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

/**
 * Service.
 */
final class MqttPublish
{

    private $server;
    private $port;
    private $clientId;
    
    public function __construct()
    {
        $this->server   = 'localhost';
        $this->port     = 1883;
        $this->clientId = 'app-kiosk';
    }

    /**
     * force root node to get node list
     *
     */
    public function publish(): void
    {
        $mqtt = new \PhpMqtt\Client\MqttClient($this->server, $this->port, $this->clientId);
        $mqtt->connect();
        $mqtt->publish('mesh/to/gateway', "{'cmd':'getNodes'}", 0);
        $mqtt->disconnect();
    }

    /**
     * 
     */
    public function publishRouteForMac(String $mac = "", String $Destiny = ""): void
    {
        $mqtt = new \PhpMqtt\Client\MqttClient($this->server, $this->port, $this->clientId);
        $mqtt->connect();
        $mqtt->publish('mesh/to/gateway',
                        "{'cmd':'regDev','mac':'$mac','route':[{'id':680917897,'dir':1},{'id':674782793,'dir':0},{'id':309082205,'dir':1},{'id':681009253,'dir':3}]}",
                        0);
        $mqtt->disconnect();
    }

}
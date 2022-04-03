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
     * Create a new user.
     *
     *
     * @return int The new user ID
     */
    public function publish(): void
    {
        $mqtt = new \PhpMqtt\Client\MqttClient($this->server, $this->port, $this->clientId);
        $mqtt->connect();
        $mqtt->publish('mesh/to/gateway', "{'cmd':'getNodes'}", 0);
        $mqtt->disconnect();
    }

}
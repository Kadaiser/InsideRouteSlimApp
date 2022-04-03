<?php

namespace App\Domain\Mqtt\Service;

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

/**
 * Service.
 */
final class MqttSubscribe
{

    private $server;
    private $port;
    private $clientId;
    private $connectionSettings;
    private $username;
    private $password;
    private $clean_session;
    private $mqtt;
    
    public function __construct()
    {
        $this->server   = 'localhost';
        $this->port     = 1883;
        $this->clientId = 'app-kiosk';
        $this->username = 'ap';
        $this->password = null;
        $this->clean_session = false;

        
        
        $this->connectionSettings  = new ConnectionSettings();
        $this->connectionSettings
        ->setUsername($this->username)
        ->setPassword(null)
        ->setKeepAliveInterval(60)
        ->setLastWillTopic('emqx/test/last-will')
        ->setLastWillMessage('client disconnect')
        ->setLastWillQualityOfService(1);

        $this->mqtt = new MqttClient($this->server, $this->port, $this->clientId);
    }

    /**
     *
     *
     */
    public function subscribe(): void
    {
        $this->mqtt->connect($this->connectionSettings, $this->clean_session);
        printf("client connected\n");
        
        $this->mqtt->subscribe('#', function ($topic, $message) {
            printf("Received message on topic [%s]: %s\n", $topic, $message);
        }, 0);
        
        
        $this->mqtt->loop(true);
        $this->mqtt->disconnect();
        
    }

}
<?php

namespace App\Domain\Mesh\Service;
use App\Domain\Mqtt\Service\MqttPublish;
use App\Domain\Mqtt\Service\MqttSubscribe;

/**
 * Service.
 */
final class MeshStatus
{

    private $MqttPublish;
    private $MqttSubscribe;
    
    public function __construct(MqttPublish $MqttPublish, MqttSubscribe $MqttSubscribe)
    {
        $this->MqttPublish = $MqttPublish;
        $this->MqttSubscribe = $MqttSubscribe;
    }

    /**
     *
     *
     * @return array
     */
    public function getNodeList(): void
    {
        $this->MqttSubscribe->subscribe();
    }

    /**
     * Publish at Mqtt broker
     */
    public function publish(): array
    {
        $this->MqttPublish->publish();
        return $this->getNodeListSimulated();
    }


    /**
     * Input validation.
     *
     *
     * @throws ValidationException
     *
     * @return array
     */
    private function getNodeListSimulated(): array
    {
        $errors = $response = [];

        $response = [680917897,674782793];

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }

        return $response;
    }
}
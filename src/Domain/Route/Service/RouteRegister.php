<?php

namespace App\Domain\Route\Service;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class RouteRegister
{

    /**
     * The constructor.
     *
     */
    public function __construct()
    {

    }

    /**
     * Create a new user.
     *
     * @param array $data The form data
     *
     * @return bool confirm the route register for device
     */
    public function registerRoute(array $data): bool
    {
        // Input validation
        $this->validateNewDevice($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return true;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateNewDevice(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['mac'])) {
            $errors['mac'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
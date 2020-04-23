<?php

declare(strict_types=1);

namespace App\Util;

use App\Exception\RouteeException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Routee
{
    private const AUTH_URL = 'https://auth.routee.net';
    private const CONNECT_URL = 'https://connect.routee.net';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $appSecret;

    /**
     * @var string|null
     */
    private $token;

    /**
     * @param string $appId
     * @param string $appSecret
     */
    public function __construct(string $appId, string $appSecret)
    {
        $this->client = new Client();
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    /**
     * @param string $message
     * @param string $phoneNumber
     * @param string $from
     *
     * @throws RouteeException
     */
    public function sendSMS(string $message, string $phoneNumber, string $from): void
    {
        $this->auth();

        try {
            $response = $this->client->post(self::CONNECT_URL.'/sms', [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->token,
                ],
                'json' => [
                    'body' => $message,
                    'to' => $phoneNumber,
                    'from' => $from,
                ],
            ]);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            if ($response->getStatusCode() === 400) {
                throw new RouteeException($exception->getMessage());
            }
        }

        if ($response->getStatusCode() !== 200) {
            throw new RouteeException('Failed to send SMS notification');
        }
    }

    /**
     * @throws RouteeException
     */
    private function auth(): void
    {
        $authToken = $this->getAuthToken();
        $this->initAccessToken($authToken);
    }

    /**
     * @param string $authToken
     * @throws RouteeException
     */
    private function initAccessToken(string $authToken): void
    {
        try {
            $response = $this->client->post(self::AUTH_URL.'/oauth/token', [
                'body' => 'grant_type=client_credentials',
                'headers' => [
                    'Authorization' => 'Basic '.$authToken,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
            ]);
        } catch (\Exception $exception) {
            throw new RouteeException('Authentication failed: '.$exception->getMessage());
        }

        $content = json_decode($response->getBody()->getContents(), true);
        if (!isset($content['access_token'])) {
            throw new RouteeException('Authentication failed: unknown reasons');
        }

        $this->token = $content['access_token'];
    }

    /**
     * @return string
     */
    private function getAuthToken(): string
    {
        return base64_encode($this->appId.':'.$this->appSecret);
    }
}
<?php

declare(strict_types=1);

namespace App\Util;

use GuzzleHttp\Client;

class Routee
{
    private const API_URL = 'https://auth.routee.net';
    private const DEFAULT_EXPIRATION = 3600;

    private $client;
    private $token;
    private $lastSent = 0;
    private $expiresIn;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function auth()
    {
        if (!$this->isExpired()) {
            return;
        }

        $authToken = $this->getAuthToken();
        $this->getAccessToken($authToken);
    }

    public function getAccessToken(string $authToken)
    {
        try {
            $response = $this->client->post(self::API_URL.'/oauth/token', [
                'body' => 'grant_type=client_credentials',
                'headers' => [
                    'Authorization' => 'Basic '.$authToken,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
            ]);
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }

        $content = json_decode($response->getBody()->getContents(), true);

        $this->expiresIn = $content['expires_in'] ?? self::DEFAULT_EXPIRATION;
        if (!isset($content['access_token'])) {
            throw new \LogicException();
        }
    }

    public function getAuthToken(): string
    {
        $appId = getenv('ROUTEE_APP_ID');
        $appSecret = getenv('ROUTEE_APP_SECRET');

        return base64_encode($appId.':'.$appSecret);
    }

    public function isExpired()
    {

    }

    public function sendSMS()
    {
        
    }
}
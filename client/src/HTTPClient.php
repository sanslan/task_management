<?php

namespace App;

use Psr\Http\Client\ClientInterface;

class HTTPClient
{
    private $client;

    public function __construct(ClientInterface $client)
    {

        $this->client = $client;
    }

    public function fetchJSON(string $uri, string $type, array $params = [],array $headers = [])
    {
        $default_params = [
            'timeout' => 2.0,
            'headers' => array_merge($headers, ['Accept' => 'application/json','Content-Type' => 'application/json'])
        ];
        $params = array_merge($default_params,$params);
        $response = $this->client->request($type, $uri, $params);

        return json_decode($response->getBody()->getContents());
    }

}
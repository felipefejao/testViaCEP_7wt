<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use HttpException;

class ViaCepService implements ViaCepServiceContract
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $postalCode)
    {
        try {
            $response =  $this->client->get("viacep.com.br/ws/$postalCode/json/");

            return json_decode($response->getBody()->getContents());
        } catch (ClientException $clientException) {
            return [
                "cep" => $postalCode,
                "message" => "Código inválido",
                "error_code" => $clientException->getCode()
            ];
        }
    }
}

<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiRequestService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send a POST request to the API
     *
     * @param string $url
     * @param array $data
     * @return array
     */
    public function sendPostRequest(string $url, $data, array $headers = []): array
    {
        try {
            $response = $this->client->post($url, [
                'json' => $data,
                'headers' => $headers,
            ]);
            if(!empty($headers)){
                dd($response->getBody()->getContents());die;
            }
            // Assuming the response is JSON
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Handle errors (e.g., log or throw an exception)
            return [
                'error' => 'Request failed',    
                'message' => $e->getMessage()
            ];
        }
    }


    /**
     * Send a GET request to the API
     *
     * @param string $url
     * @return array
     */
    public function sendGetRequest(string $url): array
    {
        try {
            $response = $this->client->get($url);

            // Assuming the response is JSON
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Handle errors
            return [
                'error' => 'Request failed',
                'message' => $e->getMessage()
            ];
        }
    }
}

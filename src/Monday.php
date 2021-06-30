<?php

namespace Nishstha\Monday;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Monday
{

  protected $client;
  protected $response;

  public function __construct()
  {
    $this->client = new Client([
      'base_uri' => config('monday.api_url'),
      'headers' => [
        'Content-Type' => 'application/json',
        'Authorization' => config('monday.api_key')
      ]
    ]);
    $this->initialSetup();
  }

  private function initialSetup()
  {
    $this->response = null;
  }

  private function handleExecption(GuzzleException $e)
  {
    return response()->json([
      'error' => $e->getMessage(),
    ], 500);
  }

  /**
   * Method to query/mutate monday api
   * 
   * @param string $query "This is the raw GraphQL query" 
   * @param boolean $getData
   */
  public function call($query, $getData = false)
  {
    $this->initialSetup();

    try {
      $this->setResponse($this->client->post('', [
        'form_params' => [
          'query' => $query
        ],
      ]));
      return $getData ? $this->getResponseData() : $this->response;
    } catch (GuzzleException $e) {
      return $this->handleExecption($e);
    }
  }

  /**
   * Returns the data key from monday api response if possible
   * 
   * @return boolean|object
   */
  public function getResponseData()
  {
    if ($this->response !== null && $this->response->getStatusCode() == 200) {
      return json_decode($this->response->getBody()->getContents())->data;
    } else {
      return false;
    }
  }

  /**
   * Get last api response
   * 
   * @return null|\GuzzleHttp\Psr7\Response
   */
  public function getResponse()
  {
    return $this->response;
  }


  /**
   * Set response parameter
   * 
   * @param \GuzzleHttp\Psr7\Response
   */
  protected function setResponse($response)
  {
    $this->response = $response;
  }
}

<?php

namespace GitHubToRally;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Rally {

  /**
   * @var \GitHubToRally\Config
   */
  protected $config;

  /**
   * @var \GuzzleHttp\Client
   */
  protected $client;

  /**
   * Rally constructor.
   * @param \GitHubToRally\Config $config
   *
   * See @link http://docs.guzzlephp.org/en/latest/request-options.html Guzzle request options. @endlink
   */
  public function __construct(Config $config) {
    $this->config = $config;
    $this->config->validateKeys(['user', 'pass', 'project_id', 'domain']);

    $this->client = new Client([
      'base_uri' => 'https://' . $this->config->getValue('domain') . '/slm/webservice/v2.0/',
      // @todo Perhaps make timeout configurable. I suppose we could also allow
      //   nearly any of the Guzzle request options to be set in config, but
      //   there are limits to the Rallydev webservices, so we don't want to
      //   be that permissive. Also we want config to be simple.
      'timeout'  => 5.0,
      'auth' => [
        $this->config->getValue('user'),
        $this->config->getValue('pass'),
      ],
    ]);
  }

  /**
   * @return \GuzzleHttp\Client
   */
  public function getClient() {
    return $this->client;
  }

  /**
   * Returns a response result.
   *
   * See @link http://docs.guzzlephp.org/en/latest/quickstart.html#using-responses Using Guzzle responses. @endlink
   *
   * @param \Psr\Http\Message\ResponseInterface $response
   * @return mixed
   *   A decoded JSON response body.
   * @throws \Exception
   *
   * @see \GuzzleHttp\Psr7\Response
   */
  public function result(ResponseInterface $response) {
    switch ($response->getStatusCode()) {
      case 200:
        $body = $response->getBody()->getContents();
        if ($data = json_decode($body)) {
          return $data;
        }
        else {
          throw new \Exception('The HTTP response body could not be decoded.');
        }
        break;
      default:
        throw new \Exception('The HTTP response was not successful.');
    }
  }

}

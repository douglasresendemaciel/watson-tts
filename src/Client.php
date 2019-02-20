<?php

namespace Robtesch\Watsontts;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Config;

/**
 * Class Client
 * @package Robtesch\Watsontts
 */
class Client extends GuzzleClient
{

    protected $endpoint;
    protected $apiVersion;
    protected $username;
    protected $password;
    protected $client;

    /**
     * Client constructor.
     * @param array|null $config
     */
    public function __construct(array $config = null)
    {
        $this->endpoint = $config['endpoint'] ?? Config::get('watson-tts.endpoint', 'https://stream.watsonplatform.net/text-to-speech/api');
        $this->apiVersion = $config['api_version'] ?? Config::get('watson-tts.api_version', 'v1');
        $this->username = $config['username'] ?? Config::get('watson-tts.username', '');
        $this->password = $config['password'] ?? Config::get('watson-tts.password', '');
        parent::__construct([
            'base_uri' => $this->endpoint . "/" . ltrim($this->apiVersion, "/") . "/",
            'auth'     => [$this->username, $this->password],
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $uri = "", array $options = [])
    {
        $uri = ltrim($uri, "/");

        return json_decode((string)parent::request($method, $uri, $options)
                                         ->getBody());
    }

    /**
     * @param string $endpoint
     * @return $this
     */
    public function setEndpoint(string $endpoint)
    : self {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @param string $apiVersion
     * @return $this
     */
    public function setApiVersion(string $apiVersion)
    : self {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username)
    : self {
        $this->username = $username;

        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password)
    : self {
        $this->password = $password;

        return $this;
    }
}
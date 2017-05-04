<?php
/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 01.05.2017
 * Time: 19:46
 */

namespace RenodoApiClient;


use RenodoApiClient\httpClientAdapters\HttpClientAdapterInterface;
use RenodoApiClient\httpClientAdapters\NateGoodHttpClientAdapter;
use RenodoApiClient\interfaces\ClientBuilderInterface;

class ClientBuilder implements ClientBuilderInterface
{
    /**
     * @var string
     */
    private $baseUrl;
    /**
     * @var string
     */
    private $token;

    /**
     * @var HttpClientAdapterInterface
     */
    private $httpAdapter;

    /**
     * @var string
     */
    private $version;

    /**
     * @param $baseUrl string
     * @return ClientBuilderInterface
     */
    public function setBaseUrl($baseUrl)
    {
        $this->guardIsItUrl($baseUrl);
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @param $version string
     * @return ClientBuilderInterface
     */
    public function setVersion($version)
    {
       $this->version = $version;
        return $this;
    }

    /**
     * @param $token string
     * @return ClientBuilderInterface
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param HttpClientAdapterInterface $httpAdapter
     * @return $this
     */
    public function setHttpAdapter(HttpClientAdapterInterface $httpAdapter)
    {
        $this->httpAdapter = $httpAdapter;
        return $this;
    }

    /**
     * @return Client
     * @throws \InvalidArgumentException
     */
    public function build()
    {
        $client = new Client($this->getHttpAdapter());
        if($this->baseUrl !== null){
            $client->setBaseUrl($this->baseUrl);
        }

        if($this->version !== null){
            $client->setVersion($this->version);
        }

        if($this->token !== null){
           $client->setToken($this->token);
        }

        return $client;

    }

    /**
     * @param $url string
     */
    private function guardIsItUrl($url){
        if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){
            throw new \InvalidArgumentException("{$url} is not URL", 100);
        };
    }

    private function getHttpAdapter(){
        //default value
        if($this->httpAdapter === null){
            return new NateGoodHttpClientAdapter();
        }

        return $this->httpAdapter;
    }

}
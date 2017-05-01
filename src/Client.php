<?php

namespace RenodoApiClient\client;

use RenodoApiClient\dto\ResponseDto;
use RenodoApiClient\httpClientAdapters\HttpClientAdapterInterface;
use RenodoApiClient\interfaces\ClientInterface;
use RenodoApiClient\interfaces\ResponseInterface;


/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 01.05.2017
 * Time: 17:58
 */
class Client implements ClientInterface
{
    /**
     * @var HttpClientAdapterInterface
     */
    private $httpClientAdapter;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * Client constructor.
     * @param HttpClientAdapterInterface $httpClientAdapter
     */
    public function __construct(HttpClientAdapterInterface $httpClientAdapter)
    {
        $this->httpClientAdapter = $httpClientAdapter;
    }

    /**
     * Делает запрос на удаленный ресурс, принимает как полный url типа: http://renodoapi.m2000.me/v1/url/284ff888abf3b37db115d4674c3eb2c1
     * Так и сокращенный: url/284ff888abf3b37db115d4674c3eb2c1
     * Во втором случае полный URL формируется из предзаданный настроек(version, baseUrl), в первом случае(полный URL) - настройки игнорируются
     * @param string $url
     * возвращает ответ в виде отдельного обьекта Response
     * @return ResponseInterface
     */
    public function get($url)
    {
        $response = $this->httpClientAdapter->get($this->makeUrl($url), $this->token);
        return $this->makeResponse($response);
    }

    /**
     * Send POST request
     * @param $url string
     * @param array $data
     * @return ResponseInterface
     */
    public function post($url, array $data)
    {
        $response = $this->httpClientAdapter->post($this->makeUrl($url), $data, $this->token);
        return $this->makeResponse($response);
    }

    /**
     * Send PUT request
     * @param $url string
     * @param array $data
     * @return ResponseInterface
     */
    public function put($url, array $data)
    {
        $response = $this->httpClientAdapter->put($this->makeUrl($url), $data, $this->token);
        return $this->makeResponse($response);
    }

    /**
     * Send DELETE request
     * @param $url
     * @return ResponseInterface
     */
    public function delete($url)
    {
        $response = $this->httpClientAdapter->delete($this->makeUrl($url), $this->token);
        return $this->makeResponse($response);
    }

    /**
     * @param ResponseDto $response
     * @return ResponseInterface
     */
    private function makeResponse(ResponseDto $response)
    {
        return new Response($response);
    }

    /**
     * @param $url string
     * @return string
     */
    private function makeUrl($url)
    {
        if ($this->isItFullUrl($url)) {
            return $url;
        } else {
            return $this->composeUrl($url);
        }
    }

    /**
     * @param $url string
     * @return boolean
     */
    private function isItFullUrl($url){
        return filter_var($url, FILTER_VALIDATE_URL) !== FALSE;
    }

    /**
     * @param $url string
     * @return string
     */
    private function composeUrl($url){
        $this->guardBaseUrlIsSet();
        $this->guardVersionIsSet();

        return $this->baseUrl . '/' . $this->version . '/' . $url;
    }

    private function guardBaseUrlIsSet(){
        if($this->baseUrl === null)
            throw new \InvalidArgumentException('You must set baseUrl property');
    }

    private function guardVersionIsSet(){
        if($this->version === null)
            throw new \InvalidArgumentException('You must set baseUrl property');
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @param $baseUrl string
     */
    public function setBaseUrl($baseUrl)
    {
        if(!$this->isItFullUrl($baseUrl)){
            throw new \InvalidArgumentException('Base url must be url');
        }
        $this->baseUrl = $baseUrl;
    }


}
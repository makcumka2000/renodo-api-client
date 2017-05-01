<?php

namespace RenodoApiClient\interfaces;

interface ClientInterface
{

    /**
     * Делает запрос на удаленный ресурс, принимает как полный url типа: http://renodoapi.m2000.me/v1/url/284ff888abf3b37db115d4674c3eb2c1
     * Так и сокращенный: url/284ff888abf3b37db115d4674c3eb2c1
     * Во втором случае полный URL формируется из предзаданный настроек(version, baseUrl), в первом случае(полный URL) - настройки игнорируются
     * @param string $url
     * возвращает ответ в виде отдельного обьекта Response
     * @return ResponseInterface
     */
    public function get($url);

    /**
     * Send POST request
     * @param $url string
     * @param array $data
     * @return ResponseInterface
     */
    public function post($url, array $data);

    /**
     * Send PUT request
     * @param $url string
     * @param array $data
     * @return ResponseInterface
     */
    public function put($url, array $data);

    /**
     * Send DELETE request
     * @param $url
     * @return ResponseInterface
     */
    public function delete($url);







}
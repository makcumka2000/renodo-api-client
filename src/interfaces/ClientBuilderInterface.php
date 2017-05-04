<?php

namespace RenodoApiClient\interfaces;
use RenodoApiClient\Client;

/**
 * Вспомогательный класс для построения клиента
 * Можно создать клиента вручную:
 * $client = new Client($baseUrl, $version);
 * $client->setToken($token);
 * А можно с помощью этого строителя:
 * $client = (new ClientBuilder())->setBaseUrl($baseUrl)->setVersion($version)->setToken($token)->build();
 * Тут опциально, как удобнее.
 */
interface ClientBuilderInterface
{
    /**
     * @param $baseUrl string
     * @return ClientBuilderInterface
     */
    public function setBaseUrl($baseUrl);

    /**
     * @param $version string
     * @return ClientBuilderInterface
     */
    public function setVersion($version);



    /**
     * @param $token string
     * @return ClientBuilderInterface
     */
    public function setToken($token);

    /**
     * @return Client
     * @throws \InvalidArgumentException
     */
    public function build();

}
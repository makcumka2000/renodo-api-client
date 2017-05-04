<?php

/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 04.05.2017
 * Time: 23:17
 */
class ClientBuilderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \RenodoApiClient\ClientBuilder();
     */
    private $model;

    public function setUp()
    {
        $this->model = new \RenodoApiClient\ClientBuilder();
    }

    public function testSetWrongUrl()
    {
        try{
            $this->model->setBaseUrl('wrong url');
            $this->fail();
        }catch (Exception $exception){
            $this->assertEquals(100, $exception->getCode());
        }
    }

    public function testSetVersion(){
        $version = 'version';
        $client = $this->model->setVersion($version)->build();
        $this->assertEquals($version, $client->getVersion());
    }

    public function testSetBaseUrl(){
        $url = 'http://m2000.me';
        $client = $this->model->setBaseUrl($url)->build();
        $this->assertEquals($url, $client->getBaseUrl());
    }

    public function testSetToken(){
        $token = 'token';
        $client = $this->model->setToken($token)->build();
        $this->assertEquals($token, $client->getToken());
    }

    public function testAllTogether(){
        $version = 'version';
        $url = 'http://m2000.me';
        $token = 'token';
        $client = $this->model->setVersion($version)->setBaseUrl($url)->setToken($token)->build();
        $this->assertEquals($version, $client->getVersion());
        $this->assertEquals($url, $client->getBaseUrl());
        $this->assertEquals($token, $client->getToken());
    }
}
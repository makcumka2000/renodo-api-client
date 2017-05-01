<?php

require_once ('vendor/autoload.php');

use RenodoApiClient\ClientBuilder;

$token = '58fb0a080cbbc58fb0a080cbf758fb0a';
$baseUrl = 'http://renodoapi.m2000.me';
$version = 'v1';

$client = (new ClientBuilder())
    ->setToken($token)
    ->setBaseUrl($baseUrl)
    ->setVersion($version)
    ->build();

$response = $client->get('url');

//Данные запроса
$rows = $response->getData();

//Успешный запрос или нет
$response->isSuccess();

//Сообщение об ошибке
$response->getErrorMessage();

//Обьект паджинации(может вернуть null в случае если паджинации нет)
$response->getPagination();

//Url следующей страницы
$response->getPagination()->getNextPageUrl();
//Url текущей страницы
$response->getPagination()->getSelfPageUrl();
//Url последней страницы
$response->getPagination()->getLastPageUrl();
//Url первой страницы
$response->getPagination()->getFirstPageUrl();
//Кол-во записей для отображения
$response->getPagination()->getTotalCount();





<?php

namespace RenodoApiClient\interfaces;

/**
 * Класс, возвращающийся после запроса Rest клиента
 * Interface Response
 */
interface ResponseInterface
{
    /**
     * Возвращает массив информации из ответа
     * @return array
     */
    public function getData();

    /**
     * Возвращает заголовок ответа в виде массива данных
     * @return array
     */
    public function getHeaders();

    /**
     * Информация о страницах из ответа.
     * Инкапсулирова в отдельном обьекте
     * Может возвращать null в случае отсутствия паджинации(например при просмотре данных о конкретной записи)
     * @return PaginationInterface|null
     */
    public function getPagination();

    /**
     * Успешный запрос или нет
     * @return boolean
     */
    public function isSuccess();

    /**
     * Возвращает тело ответа в чистом виде, в виде текста
     * @return string
     */
    public function getRawData();

    /**
     * Возвращает заголовки в чистом виде, в виде текста
     * @return string
     */
    public function getRawHeaders();

    /**
     * Возвращает код ответа, например: 404 или 200
     * @return integer
     */
    public function getCode();

    /**
     * Возвращает описание ошибки, в случае неудачного вызова
     * @return string
     */
    public function getErrorMessage();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @return boolean
     */
    public function hasPagination();
}
<?php
/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 01.05.2017
 * Time: 18:34
 */

namespace RenodoApiClient;


use RenodoApiClient\dto\ResponseDto;
use RenodoApiClient\interfaces\PaginationInterface;
use RenodoApiClient\interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var ResponseDto
     */
    private $dto;

    /**
     * @var Pagination
     */
    private $pagination;

    public function __construct(ResponseDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Возвращает массив информации из ответа
     * @return array
     */
    public function getData()
    {
        return $this->dto->data;
    }

    /**
     * Возвращает заголовок ответа в виде массива данных
     * @return array
     */
    public function getHeaders()
    {
        return $this->dto->headers;
    }

    /**
     * Информация о страницах из ответа.
     * Инкапсулирова в отдельном обьекте
     * Может возвращать null в случае отсутствия паджинации(например при просмотре данных о конкретной записи)
     * @return PaginationInterface|null
     */
    public function getPagination()
    {
        if($this->hasPagination() && $this->pagination === null){
            $this->pagination = new Pagination($this->dto->paginationDto);
        }
        return $this->pagination;
    }

    /**
     * @return bool
     */
    public function hasPagination(){
        return $this->dto->paginationDto !== null;
    }

    /**
     * Успешный запрос или нет
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->dto->success;
    }

    /**
     * Возвращает тело ответа в чистом виде, в виде текста
     * @return string
     */
    public function getRawData()
    {
        return $this->dto->rawData;
    }

    /**
     * Возвращает заголовки в чистом виде, в виде текста
     * @return string
     */
    public function getRawHeaders()
    {
        return $this->dto->rawHeaders;
    }

    /**
     * Возвращает код ответа, например: 404 или 200
     * @return integer
     */
    public function getCode()
    {
        return $this->dto->code;
    }

    /**
     * Возвращает описание ошибки, в случае неудачного вызова
     * @return string
     */
    public function getErrorMessage()
    {
        $message = '';
        if(!empty($this->dto->data->message)){
            $message .=  $this->dto->data->message;
        }
        if(!empty($this->dto->message)){
            $message .=  PHP_EOL.$this->dto->message;
        }
        return $message;
    }

    public function getStatus(){
        return $this->dto->status;
    }

}
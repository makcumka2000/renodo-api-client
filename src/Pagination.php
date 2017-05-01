<?php
/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 01.05.2017
 * Time: 19:42
 */

namespace RenodoApiClient;


use RenodoApiClient\dto\PaginationDto;
use RenodoApiClient\interfaces\PaginationInterface;

class Pagination implements PaginationInterface
{
    /**
     * @var PaginationDto
     */
    private $dto;

    /**
     * Pagination constructor.
     * @param PaginationDto $dto
     */
    public function __construct(PaginationDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * @return string
     */
    public function getSelfPageUrl()
    {
        return $this->dto->self;
    }


    /**
     * URl на первую страницу результата
     * @return string
     */
    public function getFirstPageUrl()
    {
        return $this->dto->first;
    }

    /**
     * URl на последнюю страницу результата
     * @return string
     */
    public function getLastPageUrl()
    {
        return $this->dto->last;
    }

    /**
     * URl на следующую страницу результата
     * @return string|null
     */
    public function getNextPageUrl()
    {
        return $this->dto->next;
    }

    /**
     * URl на предыдущую страницу результата
     * @return string|null
     */
    public function getPrevPageUrl()
    {
        return $this->dto->prev;
    }

    /**
     * Возврщает общее количество записей в результате
     * @return int
     */
    public function getTotalCount()
    {
        return $this->dto->totalCount;
    }

    /**
     * Количество страниц в паджинации
     * @return int
     */
    public function getPageCount()
    {
        return $this->dto->pageCount;
    }

    /**
     * Номер текущей страницы
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->dto->currentPage;
    }

    /**
     * Количество записей на страницу
     * @return int
     */
    public function getRowsPerPage()
    {
        return $this->dto->perPage;
    }


}
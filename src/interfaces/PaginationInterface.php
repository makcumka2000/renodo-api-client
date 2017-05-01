<?php

namespace RenodoApiClient\interfaces;

/**
 * Класс инкапсулирющий в себе работу со страницами
 */
interface PaginationInterface
{
    /**
     * @return string
     */
    public function getSelfPageUrl();

    /**
     * URl на первую страницу результата
     * @return string
     */
    public function getFirstPageUrl();

    /**
     * URl на последнюю страницу результата
     * @return string
     */
    public function getLastPageUrl();

    /**
     * URl на следующую страницу результата
     * @return string|null
     */
    public function getNextPageUrl();

    /**
     * URl на предыдущую страницу результата
     * @return string|null
     */
    public function getPrevPageUrl();

    /**
     * Возврщает общее количество записей в результате
     * @return int
     */
    public function getTotalCount();

    /**
     * Количество страниц в паджинации
     * @return int
     */
    public function getPageCount();

    /**
     * Номер текущей страницы
     * @return int
     */
    public function getCurrentPage();

    /**
     * Количество записей на страницу
     * @return int
     */
    public function getRowsPerPage();

}
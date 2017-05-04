<?php

/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 04.05.2017
 * Time: 23:34
 */
class PaginationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \RenodoApiClient\dto\PaginationDto
     */
    private $dto;
    /**
     * @var \RenodoApiClient\Pagination
     */
    private $pagination;

    public function setUp()
    {
        $this->dto = new \RenodoApiClient\dto\PaginationDto();
        $this->pagination = new \RenodoApiClient\Pagination($this->dto);
    }

    public function testSelfPageUrl(){
        $this->dto->self = 'self';
        $this->assertEquals('self', $this->pagination->getSelfPageUrl());
    }

    public function testFirstPageUrl()
    {
        $this->dto->first = 'first';
        $this->assertEquals('first', $this->pagination->getFirstPageUrl());
    }

    public function testLastPageUrl()
    {
        $this->dto->last = 'last';
        $this->assertEquals('last', $this->pagination->getLastPageUrl());
    }

    public function testNextPageUrl()
    {
        $this->dto->next = 'next';
        $this->assertEquals('next', $this->pagination->getNextPageUrl());
    }

    public function testPrevPageUrl()
    {
        $this->dto->prev = 'prev';
        $this->assertEquals('prev', $this->pagination->getPrevPageUrl());
    }

    public function testTotalCount()
    {
        $this->dto->totalCount = 'total';
        $this->assertEquals('total', $this->pagination->getTotalCount());
    }

    public function testPageCount()
    {
        $this->dto->pageCount = 100;
        $this->assertEquals(100, $this->pagination->getPageCount());
    }

    public function testCurrentPage()
    {
        $this->dto->currentPage = 1;
        $this->assertEquals(1, $this->pagination->getCurrentPage());
    }

    public function testRowsPerPage()
    {
        $this->dto->perPage = 10;
        $this->assertEquals(10, $this->pagination->getRowsPerPage());
    }


}
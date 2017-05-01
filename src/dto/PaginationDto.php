<?php
/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 01.05.2017
 * Time: 19:25
 */

namespace RenodoApiClient\dto;


class PaginationDto
{
    /**
     * @var string
     */
    public $first;
    /**
     * @var string
     */
    public $prev;
    /**
     * @var string
     */
    public $next;
    /**
     * @var string
     */
    public $last;
    /**
     * @var string
     */
    public $self;

    /**
     * @var integer
     */
    public $totalCount;

    /**
     * @var integer
     */
    public $pageCount;

    /**
     * @var integer
     */
    public $currentPage;

    /**
     * @var integer
     */
    public $perPage;
}
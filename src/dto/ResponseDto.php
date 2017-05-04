<?php

namespace RenodoApiClient\dto;

/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 01.05.2017
 * Time: 18:21
 */
class ResponseDto
{
    /**
     * @var boolean
     */
    public $success;
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $status;
    /**
     * @var string
     */
    public $message;
    /**
     * @var array
     */
    public $data = [];
    /**
     * @var array
     */
    public $headers = [];
    /**
     * @var string
     */
    public $rawData;
    /**
     * @var string
     */
    public $rawHeaders;

    /**
     * @var PaginationDto
     */
    public $paginationDto;
}
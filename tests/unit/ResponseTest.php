<?php

/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 04.05.2017
 * Time: 23:43
 */
class ResponseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \RenodoApiClient\dto\ResponseDto
     */
    private $dto;

    /**
     * @var \RenodoApiClient\Response
     */
    private $response;

    public function setUp()
    {
        $this->dto = new \RenodoApiClient\dto\ResponseDto();
        $this->response = new \RenodoApiClient\Response($this->dto);
    }

    public function testGetData(){
        $this->assertTrue(is_array($this->response->getData()));
        $data = [1,2,3];
        $this->dto->data = $data;
        $this->assertEquals($data, $this->response->getData());
    }

    public function testGetHeaders(){
        $this->assertTrue(is_array($this->response->getHeaders()));
        $data = [1,2,3];
        $this->dto->headers = $data;
        $this->assertEquals($data, $this->response->getHeaders());
    }

    public function testGetNullPagination(){
        $this->assertNull($this->response->getPagination());
    }

    public function testGetNotNullPagination(){
        $this->dto->paginationDto = new \RenodoApiClient\dto\PaginationDto();
        $this->assertNotNull($this->response->getPagination());
    }

    public function testIsSuccess(){
        $this->dto->success = true;
        $this->assertTrue($this->response->isSuccess());
    }

    public function testGetRawData(){
        $data = 'raw data';
        $this->dto->rawData = $data;
        $this->assertEquals($data, $this->response->getRawData());
    }

    public function testGetRawHeaders(){
        $data = 'raw headers';
        $this->dto->rawHeaders = $data;
        $this->assertEquals($data, $this->response->getRawHeaders());
    }

    public function testGetCode(){
        $code = 200;
        $this->dto->code = $code;
        $this->assertEquals($code, $this->response->getCode());
    }

    public function testGetStatus(){
        $code = 200;
        $this->dto->status = $code;
        $this->assertEquals($code, $this->response->getStatus());
    }

    public function testGetErrorMessage(){
        $this->assertEmpty($this->response->getErrorMessage());
        $data = new stdClass();
        $this->dto->data = $data;
        $firstMessage = 'first error message';
        $secondMessage = 'second error message';
        $data->message = $firstMessage;
        $this->assertEquals($this->response->getErrorMessage(), $firstMessage);

        $this->dto->message = $secondMessage;
        $this->assertEquals($this->response->getErrorMessage(), $firstMessage.PHP_EOL.$secondMessage);

    }


}
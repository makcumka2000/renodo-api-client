<?php
/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 01.05.2017
 * Time: 18:53
 */

namespace RenodoApiClient\httpClientAdapters;


use Httpful\Response;
use RenodoApiClient\dto\PaginationDto;
use RenodoApiClient\dto\ResponseDto;
use Httpful\Request;

class NateGoodHttpClientAdapter implements HttpClientAdapterInterface
{


    /**
     * @param $url string
     * @param $token string|null
     * @return ResponseDto
     */
    public function get($url, $token = null)
    {

        $request = Request::get($url);
        $this->addTokenIfNotNull($request, $token);
        return $this->makeDto($request->send());
    }

    /**
     * @param $url string
     * @param array $data
     * @param $token string|null
     * @return ResponseDto
     */
    public function post($url, array $data, $token = null)
    {
        $request = Request::post($url, $data);
        $this->addTokenIfNotNull($request, $token);
        return $this->makeDto($request->send());
    }

    /**
     * @param $url string
     * @param array $data
     * @param $token string|null
     * @return ResponseDto
     */
    public function put($url, array $data, $token = null)
    {
        $request = Request::put($url, $data);
        $this->addTokenIfNotNull($request, $token);
        return $this->makeDto($request->send());
    }

    /**
     * @param $url string
     * @param $token string|null
     * @return ResponseDto
     */
    public function delete($url, $token = null)
    {
        $request = Request::delete($url);
        $this->addTokenIfNotNull($request, $token);
        return $this->makeDto($request->send());
    }

    private function addTokenIfNotNull(Request $request, $token){
        if($token !== null){
            $request->addHeader('Authorization','Bearer '.$token);
        }
    }

    /**
     * @param Response $response
     * @return ResponseDto
     */
    private function makeDto(Response $response){
        $dto = new ResponseDto();
        $dto->data = $this->getData($response);
        $dto->message = $response->body->message;
        $dto->code = $response->body->code;
        $dto->headers = $response->headers;
        $dto->rawData = $response->raw_body;
        $dto->rawHeaders = $response->raw_headers;
        $dto->success = $response->body->success;
        $dto->status = $response->body->status;
        if($this->responseHasPagination($response)){
            $pagination = new PaginationDto();
            $this->setPaginationLinks($pagination, $response);
            $this->setMetaLinks($pagination, $response);
            $dto->paginationDto = $pagination;
        }
        return $dto;
    }

    /**
     * @param Response $response
     * @return array
     */
    private function getData(Response $response){
        if(!empty($response->body->data->items)){
            return $response->body->data->items;
        }
        return $response->body->data;
    }

    private function responseHasPagination(Response $response){
        return !empty($response->body->data->_links) && !empty($response->body->data->_meta) ;
    }

    /**
     * @param $links string
     * @param $type string
     * @return string|null
     */
    private function setPaginationLink($links, $type){
        if(isset($links->{$type})){
            return $links->{$type}->href;
        }
        return null;
    }

    private function setPaginationLinks(PaginationDto $pagination, Response $response){
        $pagination->self = $this->setPaginationLink($response->body->data->_links, 'self');
        $pagination->first = $this->setPaginationLink($response->body->data->_links, 'first');
        $pagination->prev = $this->setPaginationLink($response->body->data->_links, 'prev');
        $pagination->next = $this->setPaginationLink($response->body->data->_links, 'next');
        $pagination->last = $this->setPaginationLink($response->body->data->_links, 'last');
    }

    private function setMetaLinks(PaginationDto $pagination, Response $response){
        $pagination->totalCount = $response->body->data->_meta->totalCount;
        $pagination->pageCount = $response->body->data->_meta->pageCount;
        $pagination->currentPage = $response->body->data->_meta->currentPage;
        $pagination->perPage = $response->body->data->_meta->perPage;
    }
}
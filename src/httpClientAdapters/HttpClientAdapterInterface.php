<?php
/**
 * Created by PhpStorm.
 * User: makcu
 * Date: 01.05.2017
 * Time: 18:18
 */

namespace RenodoApiClient\httpClientAdapters;

use RenodoApiClient\dto\ResponseDto;

interface HttpClientAdapterInterface
{
    /**
     * @param $url string
     * @param $token string|null
     * @return ResponseDto
     */
    public function get($url, $token = null);

    /**
     * @param $url string
     * @param array $data
     * @param $token string|null
     * @return ResponseDto
     */
    public function post($url, array $data, $token = null);

    /**
     * @param $url string
     * @param array $data
     * @param $token string|null
     * @return ResponseDto
     */
    public function put($url, array $data, $token = null);

    /**
     * @param $url string
     * @param $token string|null
     * @return ResponseDto
     */
    public function delete($url, $token = null);
}
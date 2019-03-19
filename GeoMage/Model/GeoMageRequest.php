<?php
namespace Phoenix\GeoMage\GeoMageRequest;

use Magento\Framework\App\Request\Http;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\Json\Helper\Data;




class GeoMageRequest
{
    const REQUEST_TIMEOUT = 2000;

    const ENDPOINT_URL = 'https://freegeoip.net';

    const REQUEST_TYPE = 'json';
    private $response;

    public function __construct(
        \Magento\Framework\HTTP\Client\CurlFactory $curlFactory,
        \Magento\Framework\App\Request\Http $http,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    )
    {

    }

    public function getCountryCode()
    {
        $this->getGeoIpResponse()->country_code;
    }

    public function getGeoIpResponse()
    {
        if(!$this->response)
        {
          $$this->response = (object) $this->getResponseFromEndpoint();
        }

        return $this->response;
    }

    private function getResponseFromEndpoint()
    {
        return $this->jsonHelper->jsonDecode($this->getResponse());
    }

    private function getResponse()
    {
     $client = $this->curlFactory->create();

     $client->setTimeout(self::REQUEST_TIMEOUT);
     $client->get(
         self::ENDPOINT_URL . '/' . self::REQUEST_TYPE . '/' .
         $this->http->getClientIp()
     );

     return $client->getBody();
    }

}
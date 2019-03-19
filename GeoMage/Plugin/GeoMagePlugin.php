<?php
namespace Phoenix\GeoMage\Plugin;
require_once BP.'/app/code/Phoenix/GeoMage/lib/geoip.inc';
use Magento\Framework\Controller\ResultFactory;
use Magento\Store\Model\StoreManager;
use Magento\Store\Model\StoreFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\FrontControllerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\Http;
use Phoenix\GeoMage\Cookie\CustomerCountry;
use Phoenix\GeoMage\Model\GeoMageRequest;
class GeoMagePlugin
{
    private $storeFactory;

    public function __construct(
        StoreFactory    $storeFactory,
        StoreCookieManagerInterface $storeCookieManagerInterface,
        GeoIpRequest    $geoIpRequest,
        ResultFactory   $resultFactory,
        StoreManager    $storeManager,
        Http            $requestHttp,
        CustomerCountry $customerCountry,
        UrlInterface    $urlInterface
    )  {
        $this->resultFactory =   $resultFactory;
        $this->storeManager  =   $storeManager;
        $this->requestHttp  =    $requestHttp;
        $this->customerCountry = $customerCountry;
        $this->urlInterface    = $urlInterface;
       }
    public function beforeDispatch(
        FrontControllerInterface $subject,
        RequestInterface $request
    ) {
        $countyCode = $this->geoIpRequest->getCountyCode();
        
        $store = $this->storeFactory->create();
        
        $store->load($countryCode, 'country_code');

        $this->storeCookieManager->setStoreCookie($store);

        return null;
        }
    }

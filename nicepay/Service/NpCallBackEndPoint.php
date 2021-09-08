<?php


namespace Daw\Nicepay\Service;


class NpCallBackEndPoint {

    private $baseUrlProd;
    private $baseUrlDev;
    private $baseUrlStaging;

    private $endPointCallbackEwallet;
    private $endPointCallbackDbProcessUrl;
    private $endPointCallbackMerchantPaymentUrl;


    /**
     * Untuk set end point callback url
     * @param $endPointCallbackEwallet
     * @param $endPointCallbackDbProcessUrl
     * @param $endPointCallbackMerchantPaymentUrl
     */
    public function setEndPointCalbackUrl($endPointCallbackEwallet, $endPointCallbackDbProcessUrl, $endPointCallbackMerchantPaymentUrl) {
        $this->endPointCallbackEwallet            = $endPointCallbackEwallet;
        $this->endPointCallbackDbProcessUrl       = $endPointCallbackDbProcessUrl;
        $this->endPointCallbackMerchantPaymentUrl = $endPointCallbackMerchantPaymentUrl;
    }

    /**
     * Untuk set base url
     * @param $baseUrlProd
     * @param $baseUrlDev
     * @param $baseUrlStaging
     */
    public function setBaseUrl($baseUrlProd, $baseUrlDev, $baseUrlStaging) {
        $this->baseUrlProd    = $baseUrlProd;
        $this->baseUrlDev     = $baseUrlDev;
        $this->baseUrlStaging = $baseUrlStaging;
    }

    // getter base url
    private function baseUrl() {
        switch ((new NpMode)->getCurrentMode()) {
            case NpMode::Development :
                return $this->baseUrlDev;
            case NpMode::Staging :
            case NpMode::Www :
                return $this->baseUrlStaging;
            case NpMode::Production :
                return $this->baseUrlProd;
            default:
                return "-";
        }
    }

    // np-callback-ewallet end point
    public function npCallBackEwallet() {
        return $this->baseUrl().$this->endPointCallbackEwallet;
    }

    // np-callback-db-process-url
    public function npCallBackEwalletDbProcessUrl() {
        return $this->baseUrl().$this->endPointCallbackDbProcessUrl;
    }

    // npMerchatPaymentUrl
    public function npMerchatPaymentUrl() {
        return $this->baseUrl().$this->endPointCallbackMerchantPaymentUrl;
    }

}

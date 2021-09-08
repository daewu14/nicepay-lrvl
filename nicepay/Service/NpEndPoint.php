<?php


namespace packages\daw\nicepay\Service;


abstract class NpEndPoint {

    protected $API_NAME = 'nicepay/direct/v2/';

    // base url
    public function baseUrl() {
        switch ((new NpMode)->getCurrentMode()) {
            case NpMode::Development :
                return "https://dev.nicepay.co.id/";
            case NpMode::Staging :
                return "https://staging.nicepay.co.id/";
            case NpMode::Production :
            case NpMode::Www :
                return "https://www.nicepay.co.id/";
                // return "https://nicepay.co.id/";
            default:
                return "-";
        }
    }

    // registration url
    public function registrationUrl() {
        return $this->baseUrl().$this->API_NAME."registration";
    }

    // check status url
    public function checkStatusUrl() {
        return $this->baseUrl().$this->API_NAME."inquiry";
    }

    // payment url
    public function paymentUrl() {
        return $this->baseUrl().$this->API_NAME."payment";
    }

    // cancel url
    public function cancelUrl() {
        return $this->baseUrl().$this->API_NAME."cancel";
    }

}

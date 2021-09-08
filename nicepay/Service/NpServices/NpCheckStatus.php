<?php


namespace daw\nicepay\Service\NpServices;

use daw\nicepay\Models\NpCkStatusRequest;
use daw\nicepay\Service\NpService;
use daw\nicepay\Utils\RestMethod;

class NpCheckStatus extends NpService {

    // check status product
    public function __construct(NpCkStatusRequest $npCkStatusRequest) {
        $this->METHOD  = RestMethod::POST;
        $this->payload = $npCkStatusRequest->data;
        $this->fixUrl  = $this->checkStatusUrl();
    }

}

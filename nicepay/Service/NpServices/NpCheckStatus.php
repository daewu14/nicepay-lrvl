<?php


namespace packages\daw\nicepay\Service\NpServices;

use packages\daw\nicepay\Models\NpCkStatusRequest;
use packages\daw\nicepay\Service\NpService;
use packages\daw\nicepay\Utils\RestMethod;

class NpCheckStatus extends NpService {

    // check status product
    public function __construct(NpCkStatusRequest $npCkStatusRequest) {
        $this->METHOD  = RestMethod::POST;
        $this->payload = $npCkStatusRequest->data;
        $this->fixUrl  = $this->checkStatusUrl();
    }

}

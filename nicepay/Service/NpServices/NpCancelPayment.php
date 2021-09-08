<?php


namespace packages\daw\nicepay\Service\NpServices;

use packages\daw\nicepay\Models\NpCancelRequest;
use packages\daw\nicepay\Service\NpService;
use packages\daw\nicepay\Utils\RestMethod;

class NpCancelPayment extends NpService {

    public function __construct(NpCancelRequest $npCancelReq) {
        $this->METHOD = RestMethod::POST;
        $this->payload = $npCancelReq->data;
        $this->fixUrl = $this->cancelUrl();
    }

}

<?php


namespace daw\nicepay\Service\NpServices;

use daw\nicepay\Models\NpCancelRequest;
use daw\nicepay\Service\NpService;
use daw\nicepay\Utils\RestMethod;

class NpCancelPayment extends NpService {

    public function __construct(NpCancelRequest $npCancelReq) {
        $this->METHOD = RestMethod::POST;
        $this->payload = $npCancelReq->data;
        $this->fixUrl = $this->cancelUrl();
    }

}

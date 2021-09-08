<?php

namespace daw\nicepay\Service\NpServices;

use daw\nicepay\Models\NpPaymentRequest;
use daw\nicepay\Service\NpService;
use daw\nicepay\Utils\RestMethod;

class NpPayment extends NpService {

    // payment billing
    public function __construct(NpPaymentRequest $npPayReq) {

        $queryParam = $npPayReq->toQueryParam($npPayReq->data);

        $this->METHOD             = RestMethod::REDIRECT;
        $this->payload            = $npPayReq->data;
        $this->isPayloadCanBeNull = true;
        $this->fixUrl             = $this->paymentUrl() . $queryParam;
    }

}

<?php

namespace packages\daw\nicepay\Service\NpServices;

use packages\daw\nicepay\Models\NpPaymentRequest;
use packages\daw\nicepay\Service\NpService;
use packages\daw\nicepay\Utils\RestMethod;

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

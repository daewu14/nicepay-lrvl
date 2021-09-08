<?php

namespace Daw\Nicepay\Service\NpServices;

use Daw\Nicepay\Models\NpPaymentRequest;
use Daw\Nicepay\Service\NpService;
use Daw\Nicepay\Utils\RestMethod;

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

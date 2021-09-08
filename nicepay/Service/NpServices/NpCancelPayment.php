<?php


namespace Daw\Nicepay\Service\NpServices;

use Daw\Nicepay\Models\NpCancelRequest;
use Daw\Nicepay\Service\NpService;
use Daw\Nicepay\Utils\RestMethod;

class NpCancelPayment extends NpService {

    public function __construct(NpCancelRequest $npCancelReq) {
        $this->METHOD = RestMethod::POST;
        $this->payload = $npCancelReq->data;
        $this->fixUrl = $this->cancelUrl();
    }

}

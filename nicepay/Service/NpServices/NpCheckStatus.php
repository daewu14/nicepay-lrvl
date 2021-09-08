<?php


namespace Daw\Nicepay\Service\NpServices;

use Daw\Nicepay\Models\NpCkStatusRequest;
use Daw\Nicepay\Service\NpService;
use Daw\Nicepay\Utils\RestMethod;

class NpCheckStatus extends NpService {

    // check status product
    public function __construct(NpCkStatusRequest $npCkStatusRequest) {
        $this->METHOD  = RestMethod::POST;
        $this->payload = $npCkStatusRequest->data;
        $this->fixUrl  = $this->checkStatusUrl();
    }

}

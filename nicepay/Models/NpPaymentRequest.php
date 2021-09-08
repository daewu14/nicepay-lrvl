<?php


namespace Daw\Nicepay\Models;


class NpPaymentRequest extends BaseNpRequest {

    var $data = [
        'tXid'             => null,
        'callBackUrl'      => null,
        'timeStamp'        => null,
        'amt'              => null,
        'merchantToken'    => null,
//        'returnJsonFormat' => null,
    ];

}

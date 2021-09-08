<?php


namespace packages\daw\nicepay\Models;


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

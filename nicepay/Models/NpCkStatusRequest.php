<?php


namespace Daw\Nicepay\Models;


class NpCkStatusRequest extends BaseNpRequest {

    var $data = [
        "timeStamp"     => null,
        "tXid"          => null,
        "iMid"          => null,
        "referenceNo"   => null,
        "amt"           => null,
        "merchantToken" => null,
    ];

}

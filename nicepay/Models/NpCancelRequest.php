<?php


namespace packages\daw\nicepay\Models;


class NpCancelRequest extends BaseNpRequest {

    var $data = [
        "timeStamp"      => null,
        "tXid"           => null,
        "iMid"           => null,
        "payMethod"      => null,
        "cancelType"     => null,
        "cancelMsg"      => null,
        "merchantToken"  => null,
        "preauthToken"   => null,
        "amt"            => null,
        "cancelServerIp" => null,
        "cancelUserId"   => null,
        "cancelUserIp"   => null,
        "cancelUserInfo" => null,
        "cancelRetryCnt" => null,
        "referenceNo"    => null,
        "worker"         => null,
    ];

}

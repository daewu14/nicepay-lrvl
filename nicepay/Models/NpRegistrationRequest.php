<?php

namespace Daw\Nicepay\Models;


class NpRegistrationRequest extends BaseNpRequest {

    var $data = [
        'bankCd'          => null,
        'timeStamp'       => null,
        'iMid'            => null,
        'payMethod'       => null,
        'currency'        => null,
        'amt'             => null,
        'referenceNo'     => null,
        'goodsNm'         => null,
        'dbProcessUrl'    => null,
        'vat'             => null,
        'fee'             => null,
        'notaxAmt'        => null,
        'description'     => null,
        'merchantToken'   => null,
        'reqDt'           => null,
        'reqTm'           => null,
        'reqDomain'       => null,
        'reqServerIP'     => null,
        'reqClientVer'    => null,
        'userIP'          => null,
        'userSessionID'   => null,
        'userAgent'       => null,
        'userLanguage'    => null,
        'cartData'        => null,
        'instmntType'     => null,
        'instmntMon'      => null,
        'recurrOpt'       => null,
        'vacctValidDt'    => null,
        'vacctValidTm'    => null,
        'merFixAcctId'    => null,
        'billingNm'       => null,
        'billingPhone'    => null,
        'billingEmail'    => null,
        'billingAddr'     => null,
        'billingCity'     => null,
        'billingState'    => null,
        'billingPostCd'   => null,
        'billingCountry'  => null,
        'deliveryNm'      => null,
        'deliveryPhone'   => null,
        'deliveryAddr'    => null,
        'deliveryCity'    => null,
        'deliveryState'   => null,
        'deliveryPostCd'  => null,
        'deliveryCountry' => null,
        'mitraCd'         => null,
    ];

}

## Laravel Payment Gateway Nicepay

## Penggunaan

```
composer require daw/nicepay
```

## Instansiasi

```

use Daw\Nicepay\Nicepay;

class PgNicepay {
    use Nicepay{
        Nicepay::__construct as construct;
    }

    public function __construct() {
        $this->construct();

        // Init key
        $MERCHANT_KEY = ""; // Merchant Key
        $MERCHANT_ID = ''; // iMid
        $REQ_DOMAIN = ''; // example.com
        $this->init($MERCHANT_KEY, $MERCHANT_ID, $REQ_DOMAIN);

        // Base URL
        $baseUrlDev = ""; // https://dev.example.com/
        $baseUrlStaging = ""; // https://dev.example.com/
        $baseUrlProd = ""; // https://example.com/
        $this->setBaseUrl($baseUrlProd, $baseUrlDev, $baseUrlStaging);

        // End point callback
        $epcEwallet = ""; // r3dr001/np-cb-ewallet
        $epcDbProcessUrl = ""; // api/v3/member/np-db-process-url
        $epcMerchantPay = ""; // r3dr001/np_payment
        $this->setEndPointCalbackUrl($epcEwallet, $epcDbProcessUrl, $epcMerchantPay);
    }
}

```

## Controller mu

```

public function test() {
    $pgNicepay = new PgNicepay();
    $npCkStReq                        = $pgNicepay->npCkStatusData();
    $npCkStReq->data['timeStamp']     = '';
    $npCkStReq->data['tXid']          = '';
    $npCkStReq->data['referenceNo']   = '';
    $npCkStReq->data['amt']           = '';
    $npCkStReq->data['merchantToken'] = '';
    return $pgNicepay->npCheckStatus($npCkStReq);
}

```

## Enjoy Coding ☕

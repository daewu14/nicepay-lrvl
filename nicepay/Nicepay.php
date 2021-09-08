<?php


namespace daw\nicepay;

use daw\nicepay\Models\NpCancelRequest;
use daw\nicepay\Models\NpCkStatusRequest;
use daw\nicepay\Models\NpPaymentRequest;
use daw\nicepay\Models\NpRegistrationRequest;
use daw\nicepay\Service\NpCallBackEndPoint;
use daw\nicepay\Service\NpServices\NpCancelPayment;
use daw\nicepay\Service\NpServices\NpCheckStatus;
use daw\nicepay\Service\NpServices\NpPayment;
use daw\nicepay\Service\NpServices\NpRegistration;
use daw\nicepay\Utils\Currency;
use daw\nicepay\Utils\NpCancelType;
use daw\nicepay\Utils\NpPaymentMethod;
use daw\nicepay\Utils\NpResponse;
use daw\nicepay\Utils\NpValidation;

trait Nicepay {

    protected $cbEndPoint;

    /// Your merchant key
    private $MERCHANT_KEY = "";
    /// Your iMid
    private $MERCHANT_ID = '';    // iMid
    /// Your reqDomain || Request Domain
    private $REQ_DOMAIN = '';

    public function __construct() {
        $this->cbEndPoint = new NpCallBackEndPoint();
    }

    /**
     * Untuk set end point callback url
     * @param $endPointCallbackEwallet
     * @param $endPointCallbackDbProcessUrl
     * @param $endPointCallbackMerchantPaymentUrl
     */
    public function setEndPointCalbackUrl($endPointCallbackEwallet, $endPointCallbackDbProcessUrl, $endPointCallbackMerchantPaymentUrl) {
        $this->cbEndPoint->setEndPointCalbackUrl($endPointCallbackEwallet, $endPointCallbackDbProcessUrl, $endPointCallbackMerchantPaymentUrl);
    }

    /**
     * Untuk set base url
     * @param $baseUrlProd
     * @param $baseUrlDev
     * @param $baseUrlStaging
     */
    public function setBaseUrl($baseUrlProd, $baseUrlDev, $baseUrlStaging) {
        $this->cbEndPoint->setBaseUrl($baseUrlProd, $baseUrlDev, $baseUrlStaging);
    }

    /**
     * Untuk set @param $MERCHANT_KEY
     * Untuk set @param $MERCHANT_ID
     * Untuk set @param $REQ_DOMAIN
     *
     * Wajib dipanggil pertamakali saat extends kelas ini
     *
     * @param $merchantKey
     * @param $iMid
     * @param $reqDomain
     */
    public function init($merchantKey, $iMid, $reqDomain) {
        $this->MERCHANT_KEY = $merchantKey;
        $this->MERCHANT_ID  = $iMid;
        $this->REQ_DOMAIN   = $reqDomain;
    }

    // instant NpRegistration
    public function npRegData() {
        return new NpRegistrationRequest();
    }

    // instant NpCkStatusRequest
    public function npCkStatusData() {
        return new NpCkStatusRequest();
    }

    // instant NpPaymentRequest
    public function npPaymentData() {
        return new NpPaymentRequest();
    }

    // instant NpCancelRequest
    public function npCancelPayData() {
        return new NpCancelRequest();
    }

    /**
     * Membuat merchant token, refno dan menampilkan waktu pembuatan merchant token
     * @return array
     */
    protected function npGenerateMerTok($amount = 0, $refNoOrTxid, $time) {
        // var merchantData = timestampTrx+iMid+refNo+amount+merchantKey;
        if ($time == null)
            $time = \Illuminate\Support\Carbon::now()->format('Ymdhis');
        if ($refNoOrTxid == null)
            $refNoOrTxid = "OID".rand(10000, 99999);
        $merchatToken = hash('sha256', $time.$this->MERCHANT_ID.$refNoOrTxid.$amount.$this->MERCHANT_KEY);
        return [
            'time'           => $time,
            'refNo'          => $refNoOrTxid,
            'merchant_token' => $merchatToken,
        ];
    }

    /**
     * Untuk check status transaksi
     *
     * @param NpCkStatusRequest $npCkStsReq
     * @return NpCheckStatus|array
     *
     * @example Cara penggunaan
     *
     * $npCkStReq                        = self::npCkStatusData();
     * $npCkStReq->data['timeStamp']     = '20210525022513';
     * $npCkStReq->data['tXid']          = 'IONPAYTEST05202105251425144232';
     * $npCkStReq->data['referenceNo']   = 'OID11222';
     * $npCkStReq->data['amt']           = '15000';
     * $npCkStReq->data['merchantToken'] = 'a6eb22ab738467edfaa6ef1245981f3607ff8157a1627e324c78e3ac3ef61e38';
     *
     * return $this->npCheckStatus($npCkStReq);
     *
     */
    public function npCheckStatus(NpCkStatusRequest $npCkStsReq) {

        $npCkStsReq->data['iMid'] = $this->MERCHANT_ID;

        $validator = NpValidation::validatorCheckStatus($npCkStsReq);
        if (!$validator['status'])
            return $validator;
        $res = new NpCheckStatus($npCkStsReq);
        return $res->call();
    }

    /**
     * Untuk membatalkan transaksi
     * @param NpCancelRequest $npCancelRequest
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @example Cara penggunaan
     *
     * $merTok                             = $this->npGenerateMerTok(15000,'IONPAYTEST05202105251448112173' )['merchant_token'];
     * $npCancelReq                        = self::npCancelPayData();
     * $npCancelReq->data['timeStamp']     = '20210525024809';
     * $npCancelReq->data['tXid']          = 'IONPAYTEST05202105251448112173';
     * $npCancelReq->data['payMethod']     = Nicepay\Utils\NpPaymentMethod::eWallet;
     * $npCancelReq->data['merchantToken'] = $merTok;
     * $npCancelReq->data['amt']           = '15000';

     * return $this->npCancelPayment($npCancelReq);
     */
    public function npCancelPayment(NpCancelRequest $npCancelRequest) {

        $npCancelRequest->data['iMid']       = $this->MERCHANT_ID;
        $npCancelRequest->data['cancelType'] = NpCancelType::FullCancel;

        $validator = NpValidation::validatorCancelPay($npCancelRequest);
        if (!$validator['status'])
            return $validator;
        $res = new NpCancelPayment($npCancelRequest);
        return $res->call();
    }

    /**
     * Untuk melakukan pembayaran nicepay
     * @param NpPaymentRequest $npPayReq
     * @return array|NpPayment
     *
     * @example Contoh penggunaan
     *
     * $npPayReq                        = self::npPaymentData();
     * $npPayReq->data['tXid']          = 'IONPAYTEST05202105251425144232';
     * $npPayReq->data['timeStamp']     = '20210525022513';
     * $npPayReq->data['amt']           = '15000';
     * $npPayReq->data['merchantToken'] = 'a6eb22ab738467edfaa6ef1245981f3607ff8157a1627e324c78e3ac3ef61e38';
     * return $this->npPayment($npPayReq);
     */
    public function npPayment(NpPaymentRequest $npPayReq) {
        $npPayReq->data['callBackUrl'] = $this->cbEndPoint->npCallBackEwallet();
        $validator = NpValidation::validatorPayment($npPayReq);
        if (!$validator['status'])
            return $validator;
        $res = new NpPayment($npPayReq);
        return $res->call();
    }

    /**
     * Untuk registrasi produk ke nicepay
     *
     * validator bisa di lihat pada :
     * @link NpValidation::validatorReg()
     * @param NpRegistrationRequest $npReg
     * @return array|NpRegistration
     */
    public function npRegistration(NpRegistrationRequest $npReg) {

        $generatedMerTok = $this->npGenerateMerTok($npReg->data['amt'], null, null);

        //  set merchant token
        $npReg->data['merchantToken'] = $generatedMerTok['merchant_token'];

        //  set timeStamp
        $npReg->data['timeStamp'] = $generatedMerTok['time'];

        // set lang payload
        $npReg->data['userLanguage'] = "ko-KR,en-US;q=0.8,ko;q=0.6,en;q=0.4";


        if (!is_a($npReg, NpRegistration::class))
            return NpResponse::failed('Invalid class parameter', null);

        // if ($npReg->data['returnJsonFormat'] == null && $npReg->data['mitraCd'] == 'ESHP')
        //     $npReg->data['returnJsonFormat'] = 0;

        if (!$npReg->data['dbProcessUrl'])
            $npReg->data['dbProcessUrl'] = $this->cbEndPoint->npCallBackEwalletDbProcessUrl();

        if (!$npReg->data['iMid'])
            $npReg->data['iMid'] = $this->MERCHANT_ID;

        if (!$npReg->data['payMethod'])
            $npReg->data['payMethod'] = NpPaymentMethod::eWallet;

        if (!$npReg->data['currency'])
            $npReg->data['currency'] = Currency::IDR;

        if (!$npReg->data['reqDomain'])
            $npReg->data['reqDomain'] = $this->REQ_DOMAIN;

        if (!$npReg->data['billingCountry'])
            $npReg->data['billingCountry'] = "Indonesia";

        if (!$npReg->data['deliveryCountry'])
            $npReg->data['deliveryCountry'] = "Indonesia";

        if (!$npReg->data['reqServerIP'])
            $npReg->data['reqServerIP'] = get_ip_address();

        if (!$npReg->data['userIP'])
            $npReg->data['userIP'] = get_ip_address();

        if (!$npReg->data['userAgent'])
            $npReg->data['userAgent'] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML,like Gecko) Chrome/60.0.3112.101 Safari/537.36";

        $npReg->data['referenceNo'] = $generatedMerTok['refNo'];

        // Validasi data payloads NpRegistration
        $validator = NpValidation::validatorReg($npReg);

        if (!$validator['status'])
            return $validator;

        $regis = new NpRegistration($npReg);

        $rs = $regis->call();

        if ($rs['status']){
            $generatedMerTok['txId'] = $rs['result']['tXid'];
            $rs['info'] = $generatedMerTok;
        }

        return $rs;
    }

}

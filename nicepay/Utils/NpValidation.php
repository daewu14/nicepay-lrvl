<?php


namespace Daw\Nicepay\Utils;

use Daw\Nicepay\Models\NpCancelRequest;
use Daw\Nicepay\Models\NpCkStatusRequest;
use Daw\Nicepay\Models\NpPaymentRequest;
use Daw\Nicepay\Models\NpRegistrationRequest;
use Illuminate\Support\Facades\Validator;

final class NpValidation {

    /**
     * global check validasi
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return array
     */
    private static function res(\Illuminate\Contracts\Validation\Validator $validator) {
        if ($validator->fails())
            return NpResponse::failed($validator->errors()->first(), null);

        return NpResponse::success("Succes validation", null);
    }

    /**
     * Untuk validasi registrasi payload
     * @param NpRegistrationRequest $npReg
     * @return array
     */
    public static function validatorReg(NpRegistrationRequest $npReg) {
        $validator = Validator::make($npReg->data,
            [
                'bankCd'          => 'sometimes', // for VA
                'timeStamp'       => 'required',
                'iMid'            => 'required',
                'payMethod'       => 'required',
                'currency'        => 'required',
                'amt'             => 'required|numeric',
                'referenceNo'     => 'required|min:8|max:8',
                'goodsNm'         => 'required',
                'dbProcessUrl'    => 'sometimes',
                'vat'             => 'sometimes',
                'fee'             => 'sometimes',
                'notaxAmt'        => 'sometimes',
                'description'     => 'sometimes',
                'merchantToken'   => 'required',
                'reqDt'           => 'sometimes',
                'reqTm'           => 'sometimes',
                'reqDomain'       => 'sometimes',
                'reqServerIP'     => 'sometimes',
                'reqClientVer'    => 'sometimes',
                'userIP'          => 'sometimes',
                'userSessionID'   => 'sometimes',
                'userAgent'       => 'sometimes',
                'userLanguage'    => 'sometimes',
                'cartData'        => 'sometimes',
                'instmntType'     => 'sometimes',
                'instmntMon'      => 'sometimes',
                'recurrOpt'       => 'sometimes',
                'vacctValidDt'    => 'sometimes', // for VA
                'vacctValidTm'    => 'sometimes', // for VA
                'merFixAcctId'    => 'sometimes', // merchant reserved va id | for VA
                'billingNm'       => 'required',
                'billingPhone'    => 'required',
                'billingEmail'    => 'sometimes|email',
                'billingAddr'     => 'sometimes',
                'billingCity'     => 'sometimes',
                'billingState'    => 'sometimes',
                'billingPostCd'   => 'required',
                'billingCountry'  => 'required',
                'deliveryNm'      => 'required',
                'deliveryPhone'   => 'required',
                'deliveryAddr'    => 'required',
                'deliveryCity'    => 'required',
                'deliveryState'   => 'required',
                'deliveryPostCd'  => 'required',
                'deliveryCountry' => 'required',
                'mitraCd'         => 'required',
            ]
        );

        return self::res($validator);
    }

    /**
     * Untuk validasi check status transaksi
     * @param NpCkStatusRequest $npCkStatusRequest
     * @return array
     */
    public static function validatorCheckStatus(NpCkStatusRequest $npCkStatusRequest) {
        $validator = Validator::make($npCkStatusRequest->data,
            [
                "timeStamp"     => 'required',
                "tXid"          => 'required',
                "iMid"          => 'required',
                "referenceNo"   => 'required',
                "amt"           => 'required',
                "merchantToken" => 'required',
            ]
        );

        return self::res($validator);
    }

    /**
     * Untuk validasi payment transaksi
     * @param NpPaymentRequest $npPayReq
     * @return array
     */
    public static function validatorPayment(NpPaymentRequest $npPayReq) {
        $validator = Validator::make($npPayReq->data,
            [
                "callBackUrl"   => 'required',
                "timeStamp"     => 'required',
                "amt"           => 'required|numeric',
                "merchantToken" => 'required',
            ]
        );

        return self::res($validator);
    }

    /**
     * Untuk validasi payment cancel
     * @param NpCancelRequest $npCancelPayReq
     * @return array
     */
    public static function validatorCancelPay(NpCancelRequest $npCancelPayReq) {
        $validator = Validator::make($npCancelPayReq->data,
            [
                "timeStamp"      => 'required',
                "tXid"           => 'required',
                "iMid"           => 'required',
                "payMethod"      => 'required',
                "cancelType"     => 'required',
                "cancelMsg"      => 'sometimes',
                "merchantToken"  => 'required',
                "preauthToken"   => 'sometimes',
                "amt"            => 'required',
                "cancelServerIp" => 'sometimes',
                "cancelUserId"   => 'sometimes',
                "cancelUserIp"   => 'sometimes',
                "cancelUserInfo" => 'sometimes',
                "cancelRetryCnt" => 'sometimes',
                "referenceNo"    => 'sometimes',
                "worker"         => 'sometimes',
            ]
        );

        return self::res($validator);
    }

}

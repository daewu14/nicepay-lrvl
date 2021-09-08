<?php


namespace packages\daw\nicepay\Utils;


final class NpResponseCode {

    // --------------------- Common Section --------------------- //
    const Success                        = '0000'; //	Success
    const ConnectionError                = '1001'; //	Connection error
    const SocketError                    = '1002'; //	Socket error
    const ServerError                    = '1003'; //	Server error
    const TimeoutError                   = '1004'; //	Timeout error
    const InvalidTrxNumber               = '9501'; //	Invalid transaction number.
    const TransactionNotAllowed          = '9502'; //	Transaction not allowed.
    const Terminated                     = '9503'; //	It has been stopped or terminated in its stores.
    const NoOffusInformation             = '9504'; //	No offus information.
    const NoBankInformation              = '9505'; //	No bank information.
    const NoMerchantPaymethodinformation = '9506'; //	No Merchant Paymethod information.
    const HttpTimeOutException           = '9507'; //	Http timeout exception.

    // --------------------- Order Section --------------------- //
    // On Going ~

    public static function statusNameLabel(NpResponseCode $statusCd) {

    }

}

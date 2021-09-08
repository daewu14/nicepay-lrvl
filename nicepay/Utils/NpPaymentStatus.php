<?php


namespace packages\daw\nicepay\Utils;


final class NpPaymentStatus {

    const Paid          = 0;
    const Failed        = 1;
    const Void          = 2;
    const Unpaid        = 3;
    const Expired       = 4;
    const ReadyToPaid   = 5; // for Alfamart
    const PaymentFailed = 6;
    const Undefined     = 7;
    const Fail          = 8;
    const Init          = 9;

    // Custom untuk kebutuhan kiriminaja
    const WaitingConfirmation = 10;

    /**
     * Untuk parsing dari statusCode menjadi pesan String
     * @param NpPaymentStatus $statusCode
     * @return string
     */
    public static function getStatusName($statusCode) {
        if ($statusCode == null)
            return "Invalid parameter";

        switch ($statusCode) {
            case self::Paid :
                return "Pembayaran berhasil";
            case self::Failed :
            case self::Fail :
            case self::PaymentFailed :
                return "Pembayaran gagal";
            case self::Void :
                return "Pembayaran berhasil dibatalkan";
            case self::Unpaid :
                return "Pembayaran belum selesai";
            case self::Expired :
                return "Pembayaran kadaluarsa";
            case self::ReadyToPaid :
                return "Billing siap dibayar";
            case self::Undefined :
                return "Invalid response";
            case self::Init :
                return "Billing berhasil dibuat";
            case self::WaitingConfirmation :
                return "Menunggu konfirmasi";
            default:
                return "Unknown";
        }

    }

    public static function getStatusColor($statusCode) {
        if ($statusCode == null)
            return "#b0bec5";

        switch ($statusCode) {
            case self::Paid :
                return "#00e676";
            case self::Failed :
            case self::Fail :
            case self::PaymentFailed :
                return "#ba68c8";
            case self::Void :
                return "#e53935";
            case self::Unpaid :
                return "#26a69a";
            case self::Expired :
                return "#fb8c00";
            case self::ReadyToPaid :
                return "#a1887f";
            case self::Init :
                return "#aaa";
            case self::Undefined :
            case self::WaitingConfirmation :
                return "#9e9e9e";
            default:
                return "#ffcdd2";
        }

    }

}

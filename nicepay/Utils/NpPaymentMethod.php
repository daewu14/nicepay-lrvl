<?php
namespace daw\nicepay\Utils;

final class NpPaymentMethod {
    const CreditCard = '01';       // Credit Card
    const VA = '02';               // Virtual Account (vacctNo) will be created
    const ConvenienceStore = '03'; // Convenience Store | Pay Number (payNo) will be created
    const ClickPay = '04';         // ClickPay | Order will be created
    const eWallet = '05';          // Order will be created
    const Payloan = '06';          // Order will be created
    const QRIS = '08';             // Order will be created

    /**
     * Untuk mendapatkan payment label
     * @param NpPaymentMethod $npPaymentMethod
     * @return string
     */
    public static function getLabelName($npPaymentMethod) {
        switch ($npPaymentMethod) {
            case self::CreditCard :
                return "Kartu kredit";
            case self::VA :
                return "Virtual Account";
            case self::ConvenienceStore :
                return "Convenience Store";
            case self::ClickPay :
                return "Click Pay";
            case self::eWallet :
                return "e-Wallet";
            case self::Payloan :
                return "Payloan";
            case self::QRIS :
                return "QRIS";
            case "transfer":
                return "Transfer";
            default:
                return "-";
        }
    }


    /**
     * Untuk mendapatkan payment label dari nicepay
     * @param NpPaymentMethod $npPaymentMethod
     * @return string
     */
    public static function getLabelNameFromNicePay($npPaymentMethod) {
        switch ($npPaymentMethod) {
            case self::CreditCard :
                return "Kartu kredit";
            case self::VA :
                return "Virtual Account";
            case self::ConvenienceStore :
                return "Convenience Store";
            case self::ClickPay :
                return "Click Pay";
            case self::eWallet :
                return "e-Wallet";
            case self::Payloan :
                return "Payloan";
            case self::QRIS :
                return "QRIS";
            default:
                return "-";
        }
    }

}

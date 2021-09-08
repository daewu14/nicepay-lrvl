<?php


namespace packages\daw\nicepay\Utils;


use packages\daw\nicepay\Service\NpMode;

class NpResponse {

    public static function success(string $text, $result) {
        return [
            'status' => true,
            'mode'   => (new NpMode)->getCurrentModeString(),
            'text'   => $text,
            'result' => $result,
        ];
    }

    public static function failed(string $text, $result) {
        return [
            'status' => false,
            'mode'   => (new NpMode)->getCurrentModeString(),
            'text'   => $text,
            'result' => $result,
        ];
    }

}

<?php


namespace packages\daw\nicepay\Utils;


class NpMitraEeallet {

    public static function all() {
        $data = [
            [
                'name'       => 'OVO',
                'code'       => 'OVOE',
                'image_link' => 'https://1.bp.blogspot.com/-Iq0Ztu117_8/XzNYaM4ABdI/AAAAAAAAHA0/MabT7B02ErIzty8g26JvnC6cPeBZtATNgCLcBGAsYHQ/s1000/logo-ovo.png',
            ],
            [
                'name'       => 'LinkAja',
                'code'       => 'LINK',
                'image_link' => 'https://pesantrenyatim.com/wp-content/uploads/2019/03/linkaja.png',
            ],
            [
                'name'       => 'DANA',
                'code'       => 'DANA',
                'image_link' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1200px-Logo_dana_blue.svg.png',
            ],
//            [
//                'name'       => 'E-Wallet Shopeepay',
//                'code'       => 'ESHP',
//                'image_link' => 'https://1.bp.blogspot.com/-EmJLucvvYZw/X0Gm1J37spI/AAAAAAAAC0s/Dyq4-ko9Eecvg0ostmowa2RToXZITkbcQCLcBGAsYHQ/w1200-h630-p-k-no-nu/Logo%2BShopeePay.png',
//            ],
            [
                'name'       => 'QRIS',
                'code'       => 'QSHP',
                'image_link' => 'https://xendit.co/wp-content/uploads/2020/03/iconQris.png',
            ],
        ];

        if (is_development()) {
            $data[] = [
                'name'       => 'E-Wallet Shopeepay',
                'code'       => 'ESHP',
                'image_link' => 'https://1.bp.blogspot.com/-EmJLucvvYZw/X0Gm1J37spI/AAAAAAAAC0s/Dyq4-ko9Eecvg0ostmowa2RToXZITkbcQCLcBGAsYHQ/w1200-h630-p-k-no-nu/Logo%2BShopeePay.png',
            ];
        }

        return collect($data);
    }

}

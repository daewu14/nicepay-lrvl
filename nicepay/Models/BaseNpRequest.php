<?php


namespace packages\daw\nicepay\Models;


class BaseNpRequest {

    /**
     * Convert data to query parameter
     * @param array $arr
     * @return null|string
     */
    public function toQueryParam($arr = []) {
        $str = null;
        foreach ($arr as $key => $value) {

            if ($str == null) {
                $str = "?".$key."=".$value;
            } else {
                $str .= "&".$key."=".$value;
            }

        }
        return $str;
    }

}

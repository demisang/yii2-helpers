<?php

namespace demi\helpers;

use yii\helpers\BaseStringHelper;

class Str extends BaseStringHelper
{
    /**
     * Replace all spaces, line breaks and tabs with a single space + remove all trailing spaces
     *
     * @param string $string
     *
     * @return string
     */
    public static function normalize($string)
    {
        if (!is_string($string)) {
            return '';
        }

        return trim(preg_replace('/[\s]+/iu', ' ', $string));
    }

    /**
     * Form a correct ending of the word
     *
     * @param integer $num   Amount
     * @param string $str1   "один" комментарий
     * @param string $str2   "несколько" (2-4) комментария
     * @param string $str3   "много" комментариев
     *
     * @param bool $num_text Whether need to add the number itself in the return value
     *
     * @return string Correct version
     */
    public static function WE($num, $str1, $str2, $str3, $num_text = true)
    {
        $val = $num % 100;

        if ($val > 10 && $val < 20) {
            return $num_text ? $num . ' ' . $str3 : $str3;
        } else {
            $val = $num % 10;
            if ($val == 1) {
                return $num_text ? $num . ' ' . $str1 : $str1;
            } elseif ($val > 1 && $val < 5) {
                return $num_text ? $num . ' ' . $str2 : $str2;
            } else {
                return $num_text ? $num . ' ' . $str3 : $str3;
            }
        }
    }

    /**
     * Returns the correct ending for the word "day" in depending on the number of days.
     *
     * @param integer $num Number of days
     *
     * @return string Correct version
     */
    public static function getDaysText($num)
    {
        return static::WE($num, 'день', 'дня', 'дней');
    }
} 
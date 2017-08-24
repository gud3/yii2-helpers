<?php

namespace gud3\helpers\other;

use yii\helpers\ArrayHelper;

/**
 * Class Helpers
 * @package gud3\helpers\other
 */
class Helpers
{
    public static function currentTime($format = 'Y-m-d H:i:s')
    {
        $time = new \DateTime();
        return $time->format($format);
    }

    public static function isTimeValid($time, $format = 'H:i:s') {
        $dt = \DateTime::createFromFormat($format, $time);
        return $dt && $dt->format($format) == $time;
    }

    public static function validZero($variable)
    {
        if ($variable < 10 && $variable != 0) {
            return '0' . $variable;
        }
        if ($variable == 0 || $variable === '') {
            return '00';
        }
        return $variable;
    }

    public static function checkDate($day, $month, $year)
    {
        return !checkdate($month, $day , $year);
    }

    public static function checkLanguage($lang, $string)
    {
        $data = [
            'en' => ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],
            'ru' => ['а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я'],
            'ua' => ['а','б','в','г','ґ','д','е','є','ж','з','и','і','ї','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ь','ю','я'],
        ];

        if (is_string($string)) {
            $temp_string = mb_strtolower($string);
            preg_match_all("#.{1}#u", $temp_string, $data);
        } else {
            throw new \Exception('params no string');
        }

        foreach ($data[0] as $sumvol) {
            if (!ArrayHelper::isIn($sumvol, $data[$lang])) {
                return false;
            }
        }

        return true;
    }
}

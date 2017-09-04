<?php

namespace gud3\heplers\dump;

/**
 * Class VarDumper
 * @package gud3\heplers\dump
 */
class VarDumper
{
    /**
     * @param $var
     */
    public static function dumpAsString($var)
    {
        echo \yii\helpers\VarDumper::dumpAsString($var, 10, true);
    }
}

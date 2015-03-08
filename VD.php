<?php

namespace demi\helpers;

use yii\helpers\BaseVarDumper;

class VD extends BaseVarDumper
{
    /**
     * Readable dump of the variable
     *
     * @param mixed $var
     * @param int $depth
     * @param bool $highlight
     */
    public static function dump($var, $depth = 10, $highlight = true)
    {
        echo static::dumpAsString($var, $depth, $highlight);
    }
} 
<?php
/**
 * @copyright Copyright (c) 2018 Ivan Orlov
 * @license   https://github.com/demisang/yii2-helpers/blob/master/LICENSE
 * @link      https://github.com/demisang/yii2-helpers#readme
 * @author    Ivan Orlov <gnasimed@gmail.com>
 */

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

<?php
/**
 * @copyright Copyright (c) 2018 Ivan Orlov
 * @license   https://github.com/demisang/yii2-helpers/blob/master/LICENSE
 * @link      https://github.com/demisang/yii2-helpers#readme
 * @author    Ivan Orlov <gnasimed@gmail.com>
 */

namespace demi\helpers\behaviors;

use yii\db\Expression;

/**
 * Yii2 TimestampBehavior for date columns in format: Y-m-d H:i:s
 */
class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Override the default value time() to `NOW()`
        if (empty($this->value)) {
            $this->value = new Expression('NOW()');
        }
    }
}

<?php
/**
 * @copyright Copyright (c) 2018 Ivan Orlov
 * @license   https://github.com/demisang/yii2-helpers/blob/master/LICENSE
 * @link      https://github.com/demisang/yii2-helpers#readme
 * @author    Ivan Orlov <gnasimed@gmail.com>
 */

namespace demi\helpers\console;

use Yii;
use yii\base\Model;
use yii\helpers\Console;

/**
 * Colorized console output helper
 */
trait ConsoleOutput
{
    public function error($message)
    {
        return Yii::$app->controller->stderr($message . PHP_EOL, Console::FG_RED);
    }

    public function info($message)
    {
        return Yii::$app->controller->stdout($message . PHP_EOL);
    }

    public function success($message)
    {
        return Yii::$app->controller->stdout($message . PHP_EOL, Console::FG_GREEN);
    }

    /**
     * Display model errors
     *
     * @param \yii\base\Model $model
     *
     * @return bool|int
     */
    public function modelErrors(Model $model)
    {
        if (!$model->hasErrors()) {
            return Yii::$app->controller->stderr('Unknown error' . PHP_EOL, Console::FG_RED);
        }

        $message = 'Errors while saving:' . PHP_EOL . PHP_EOL;

        foreach ($model->errors as $attr => $errors) {
            foreach ($errors as $error) {
                $message .= "$attr: $error" . PHP_EOL;
            }
        }

        return Yii::$app->controller->stderr($message . PHP_EOL, Console::FG_RED);
    }
}

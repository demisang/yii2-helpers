<?php

namespace demi\helpers\console;

use Yii;
use yii\base\Object;
use yii\helpers\Console;

/**
 * Class TimeLog
 *
 * @property-read string $remaining
 * @property-read float $speed
 * @property-read string $status
 */
class TimeLog extends Object
{
    public $start;
    public $all;
    public $custom = [];
    public $handled = 0;
    protected $allCountLength;

    /**
     * TimeLog constructor.
     *
     * @param int|null $allCount All data count
     * @param array $config
     */
    public function __construct($allCount = null, $config = [])
    {
        $this->start = microtime(true);
        $this->all = $allCount;
        $this->allCountLength = strlen("$allCount");

        parent::__construct($config);
    }

    /**
     * Set new handled count value
     *
     * @param int $count
     */
    public function setHandled($count)
    {
        $this->handled = $count;
    }

    /**
     * Get count handled elements per second
     *
     * @return float
     */
    public function getSpeed()
    {
        $diff = $this->diffBetweenStart();

        return $this->handled / $diff;
    }

    /**
     * Get remaining seconds
     *
     * @return int Number of seconds
     */
    public function getRemaining()
    {
        $speed = $this->speed;
        $notHandledCount = $this->all - $this->handled;

        $remainingSeconds = $speed !== 0 ? $notHandledCount / $speed : $notHandledCount;

        return round($remainingSeconds);
    }

    /**
     * Get number of seconds between start and current time
     *
     * @return float
     */
    protected function diffBetweenStart()
    {
        $current = microtime(true);

        return $current - $this->start;
    }

    /**
     * Get status message
     *
     * @return string
     */
    public function getStatus()
    {
        $speed = round($this->speed, 2);
        $remaining = $this->remaining;

        // Remaining time
        $remainingTime = $this->getFormatTime($remaining);

        // Handled
        $handled = str_pad($this->handled, $this->allCountLength, ' ', STR_PAD_LEFT);

        return "Handled: $handled/$this->all\tRemaining: $remainingTime\tSpeed: $speed/sec";
    }

    /**
     * Get formatted time
     *
     * @param float $time
     *
     * @return string
     */
    protected function getFormatTime($time)
    {
        // Remaining times
        $hours = str_pad(floor($time / 60 / 60), 2, '0', STR_PAD_LEFT);
        $minutes = str_pad(floor(($time - ((int)$hours * 60 * 60)) / 60), 2, '0', STR_PAD_LEFT);
        $seconds = str_pad(floor(($time - ((int)$hours * 60 * 60) - ((int)$minutes * 60))), 2, '0', STR_PAD_LEFT);

        return "$hours:$minutes:$seconds";
    }

    /**
     * Output start message
     */
    public function showStart()
    {
        $message = "Starting handling: $this->all items";

        Yii::$app->controller->stdout(PHP_EOL . $message . PHP_EOL, Console::FG_GREEN);
    }

    /**
     * Output status message
     *
     * @param int|null $frequency How often display a message
     */
    public function showStatus($frequency = null)
    {
        if ($frequency !== null && $this->handled % $frequency !== 0) {
            return;
        }

        Yii::$app->controller->stdout($this->status . PHP_EOL, Console::FG_YELLOW);
    }

    /**
     * Output finih message
     */
    public function showFinish()
    {
        $processingTime = $this->getFormatTime($this->diffBetweenStart());
        $message = "Finished after $processingTime\tHandled: $this->handled items";

        Yii::$app->controller->stdout(PHP_EOL . $message . PHP_EOL, Console::FG_GREEN);
    }

    /**
     * Reset current time log
     *
     * @param int|null $newAllCount
     */
    public function reset($newAllCount = null)
    {
        if ($newAllCount !== null) {
            $this->all = $newAllCount;
            $this->allCountLength = strlen("$newAllCount");
        }

        $this->start = microtime(true);
        $this->handled = 0;
    }
}
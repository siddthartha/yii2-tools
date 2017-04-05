<?php
/**
 * Class siddthartha\helpers\Variable
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */

namespace common\helpers;

/**
 * Variable tools
 *
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */
class Variable
{
    /**
     * Generates a js variable to store the `data` and attaches that to `view`s POS_READY section.
     * Returns name of variable.
     *
     * @param \yii\web\View& $view the view instance
     * @param mixed[] $data
     * @param string $namePrefix
     * @return string
     */
    public static function registerHashJSVariable(&$view, $data, $namePrefix = '_', $position = \yii\web\View::POS_READY)
    {
        $encOptions = empty($data) ? '{}' : \yii\helpers\Json::htmlEncode($data);
        $_hashVar    = $namePrefix . hash('crc32', $encOptions);
        $view->registerJs("var {$_hashVar} = {$encOptions};", $position);
        return $_hashVar;
    }

}
<?php
/**
 * Class siddthartha\helpers\Html
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */

namespace yii\helpers;

/**
 * Description of Html
 *
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */
class Html extends \yii\helpers\BaseHtml
{

    /**
     * Renders Bootstrap glyph span of given sub-class
     *
     * @param string $class
     * @return string
     */
    public static function glyph($class)
    {
        return self::tag('span', '', ['class' => "glyphicon glyphicon-{$class}"]);
    }


    /**
     * Renders Bootstrap label span
     *
     * @param string $content
     * @param string|string[] $class
     * @return string
     */
    public static function bslabel($content, $class = 'primary')
    {
        $options = is_array($class)
            ? $class
            : ['class' => "label label-{$class}"] ;

        return self::tag('span', $content, $options);
    }

    /**
     * Renders Bootstrap alert span
     *
     * @param string $content
     * @param string|string[] $class
     * @return string
     */
    public static function bsalert($content, $class = 'danger')
    {
        $options = is_array($class)
            ? $class
            : ['class' => "alert alert-{$class}"] ;

        return self::tag('div', $content, $options);
    }

//    /**
//     * @inheritdoc
//     */
//    public static function beginForm($action = '', $method = 'post', $options = array())
//    {
//        $_options = ArrayHelper::merge(['class' =>
//            ArrayHelper::merge(
//                [],
//                (\common\components\processingManager\Manager::checkRoute($action) ? [] : ["locked"])
//            ),
//        ], $options);
//
//        return parent::beginForm($action, $method, $_options);
//    }
//
//    /**
//     *
//     * @param string $label
//     * @param string|string[] $url
//     * @param string[] $options
//     * @return string
//     */
//    public static function buttonPost($label = null, $url = '', $options = [])
//    {
//        $_options = ArrayHelper::merge(['class' =>
//            ArrayHelper::merge(
//                ['btn', 'btn-link'],
//                (\common\components\processingManager\Manager::checkRoute($url) ? [] : ["locked"])
//            ),
//        ], $options);
//
//        return Html::beginForm($url, 'post')
//            . Html::submitButton($label === null ? "&rarr; " . Url::to($url) : $label, $_options)
//            . Html::endForm();
//    }
}

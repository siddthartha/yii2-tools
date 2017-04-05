<?php
/**
 * Class siddthartha\helpers\Xml
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */

namespace common\helpers;

/**
 * Description of Xml
 *
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */
class Xml
{
    public static $numericTag = 'item';

    /**
     *
     * @param string $tag
     * @param string $content
     * @param string $numericTag
     * @return string
     */
    public static function tag($tag, $content, $numericTag = null)
    {
        $_content = /*\yii\helpers\Html::encode(*/$content/*)*/;

        $_tag = is_integer($tag)
            ? ($numericTag ? $numericTag : self::$numericTag)
            : preg_replace("#[^A-Za-z0-9-_]#", '', $tag);

        return "<{$_tag}>{$_content}</{$_tag}>";
    }

    /**
     * Recursive walk
     *
     * @param mixed[] $data
     * @return string
     */
    protected static function process($data, $numericTag = null)
    {
        $_result = '';

        foreach($data as $key => $item)
        {
            $_result .= !is_array($item) ? Xml::tag($key, $item, $numericTag) : Xml::tag($key, self::process($item, $numericTag), $numericTag);
        }

        return $_result;
    }

    /**
     * Make Xml text from deep array
     *
     * @param mixed[] $data
     * @return string
     */
    public static function processArray($data, $numericTag = null)
    {
        return self::process($data, $numericTag);
    }
}
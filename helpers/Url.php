<?php
/**
 * Class siddthartha\helpers\Url
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */

namespace yii\helpers;

/**
 *
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */
class Url extends \yii\helpers\BaseUrl
{
    static public $_managers = [];

    /**
     *
     * @param string $_app
     * @return \yii\web\UrlManager
     */
    public static function getManager($_app)
    {
        if(!isset(self::$_managers[$_app]) || !self::$_managers[$_app] instanceof \yii\web\UrlManager)
        {
            $hostInfo   = \Yii::$app->urlManager->hostInfo;
            $subDomains = ArrayHelper::getValue(\Yii::$app->params, 'urlManager.subDomains', []);

            foreach($subDomains as $subDomain)
            {
                $hostInfo = $subDomain !== ''
                    ? preg_replace("#^(http[s]?:[/][/]){$subDomain}[.]#", '$1', $hostInfo)
                    : $hostInfo;
            }
            $subDomain = ArrayHelper::getValue($subDomains, $_app, '');
            $_hostInfo = preg_replace("#^(http[s]?:[/][/])#", "$1{$subDomain}.", $hostInfo);

            $config = ArrayHelper::getValue(require(\Yii::getAlias("@{$_app}/config/main.php")), 'components.urlManager', []);

            $config['hostInfo']     = $_hostInfo;
            self::$_managers[$_app] = new \yii\web\UrlManager($config);
        }

        return self::$_managers[$_app];
    }

    /**
     *
     * @param string|array $url
     * @param boolean $scheme
     */
    public static function to($url = '', $scheme = false)
    {
        if (is_string($url))
        {
            return parent::to($url, $scheme);
        }
        elseif (is_array($url) && !empty($url))
        {
            $isAbsolute = strncmp($url[0], '/', 1) === 0;
            $route = parent::normalizeRoute($url[0]);
        }

        $_parts = explode('/', trim($route, '/'));
        $root   = $_parts[0];
        $result = null;

        if(isset(\Yii::$aliases["@{$root}"])
            && is_file(\Yii::getAlias("@{$root}/config/main.php"))
        ) {
            \yii\helpers\BaseUrl::$urlManager = self::getManager($root);

            $__route  = preg_replace("#{$root}[/]*#i", "", $route);
            $url[0] = rtrim($__route, '/');

            $result = $isAbsolute
                ? self::getManager($root)->createAbsoluteUrl($url, $scheme)
                : self::getManager($root)->createUrl($url, $scheme);

            \yii\helpers\BaseUrl::$urlManager = \Yii::$app->urlManager;
        }

        $url[0] = $route;

        $base = !$result ? (
            $isAbsolute
                ? \Yii::$app->urlManager->createAbsoluteUrl($url, $scheme)
                : \Yii::$app->urlManager->createUrl($url, $scheme)
            ) : $result;

        return $base;

        /*
         *  ending slashes fix
         */

//        $query = '';
//        $anchor = '';
//
//        if(strstr($base, '?') !== false)
//        {
//            list($base, $query) = explode('?', $base);
//        }
//        elseif(strstr($base, '#') !== false)
//        {
//            list($base, $anchor) = explode('#', $base);
//        }
//
//        $base = preg_match("#[.]html$#u", $base) ? $base : rtrim($base,'/').'/';
//
//        return $base
//            . (!empty($query) ? ("?" . $query) : '')
//            . (!empty($anchor) ? ("#" . $anchor) : '');
    }
}
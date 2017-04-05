<?php
/**
 * Class siddthartha\helpers\Uuid
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */

namespace common\helpers;

/**
 * Description of Uuid
 *
 * @author Anton Sadovnikoff <sadovnikoff@gmail.com>
 */
class Uuid
{
    /**
     * Generates UUID v4 by 16-bytes  of random data
     * @link http://stackoverflow.com/a/15875555/7219759 thanks for Jack on stackoverflow
     *
     * @param mixed $data
     * @return string
     */
    public static function generate($data)
    {
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

}
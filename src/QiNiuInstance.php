<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2017/6/26
 * Time: 下午10:40
 */

namespace Laravel\QiNiu;


class QiNiuInstance
{
    private $config;
    private static $type;
    private static $uploadObject;

    public function __construct()
    {
    }


    public function getUploadInstance(string $uploadType)
    {
        if (!empty(self::$type) && self::$type == $uploadType) {
            return self::$uploadObject;
        } else {
            self::$type = $uploadType;
            switch ($uploadType) {
                case 'public';
                 self::$uploadObject = new PublicController('public');
                break;
                case 'private';
                 self::$uploadObject = new PrivateController('private');
                break;
            }
            return self::$uploadObject;
        }
    }
}
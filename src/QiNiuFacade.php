<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2017/6/28
 * Time: 下午10:47
 */

namespace Laravel\QiNiu;


use Illuminate\Support\Facades\Facade;

class QiNiuFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'qiNiuUpload';
    }
}
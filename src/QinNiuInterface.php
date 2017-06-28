<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2017/6/27
 * Time: 下午9:12
 */

namespace Laravel\QiNiu;


use Illuminate\Http\Request;

interface QinNiuInterface
{
    public function upload(Request $request, $key);
    public function uploadSingle(Request $request, $key);
    public function uploadMany(Request $request, array  $keys);
}
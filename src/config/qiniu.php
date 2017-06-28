<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2017/6/26
 * Time: 下午10:46
 */

return [

    //七牛云应用密匙
//    'accessKey' => 'P8-LPYYKsRDI8dk4ZGER01T9ve-dzyEwamEepvDb',
    'accessKey' => 'kJ1yeKo20UjXPueHKX1e54dtgRMhGiD8D8GH_J9S',

    //
//    'secretKey' => 'BdGQtJzOrr7kDDZFJCw4lm5UXX3n3EZMYbISqVuC',
    'secretKey' => 'SRXhSCBWK_Je3syJjnkqrarU4_TZwlLRh707uvCt',
    'bucket' => [
        'public' => 'project-text',
        'private' => 'private-image',
    ],
    'domain' => [
        'public' => 'http://oni63dq3q.bkt.clouddn.com',
        'private' => 'http://onvz5awzz.bkt.clouddn.com'
    ],

    //php临时处理上传目录
    'tem_path' => 'public/temp_image'

];
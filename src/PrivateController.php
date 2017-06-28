<?php
namespace Laravel\QiNiu;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2017/6/27
 * Time: 下午9:13
 */
class PrivateController implements QinNiuInterface
{
    use CommonMethods;
    private $config; //七牛配置项
    private $authObj; // 初始化签权对象
    private $uploadToken; //生成上传Token
    private $bucketName; //存储空间名
    private $uploadManager; //构建 UploadManager 对象
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
        $this->config = config('qiniu');
        $this->bucketName =  $this->config['bucket']['private'];
        $this->authObj = new Auth($this->config['accessKey'], $this->config['secretKey']);
        $this->uploadToken = $this->authObj->uploadToken($this->bucketName);
        $this->uploadManager = new UploadManager();
    }



}
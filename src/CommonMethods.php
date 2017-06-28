<?php
/**
 * Created by PhpStorm.
 * User: xingzhilong
 * Date: 2017/6/28
 * Time: 下午10:08
 */

namespace Laravel\QiNiu;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

trait CommonMethods
{
    /**
     * 上传图片，（总工厂）
     * @param Request $request
     * @param $key
     * @return array|string
     */
    public function upload(Request $request, $key)
    {
        if (is_array($key)) {
            return $this->uploadMany($request, $key);
        } else {
            return $this->uploadSingle($request, $key);
        }
    }

    /**
     * 上传单一字段
     * @param Request $request
     * @param $key
     * @return array|string
     */
    public function uploadSingle(Request $request, $key)
    {
        $temPaths = $this->dellWithImagePath($request, $key);
        $qinPath = '';
        if (!empty($temPaths['path'])) {
            $qinPath = $this->doUpload($temPaths['key'], $temPaths['path']);
        } else {
            foreach ($temPaths as $temPath) {
                $qinPath[] = $this->doUpload($temPath['key'], $temPath['path']);
            }
        }
        $this->deleteDirTemPath();
        return $qinPath;
    }

    /**
     * 集体上传图片到七牛
     * @param $key
     * @param $path
     * @return array
     */
    public function doUpload($key, $path)
    {
        list($re, $err) = $this->uploadManager->putFile($this->uploadToken, $key, $path);
        $path = $this->authObj->privateDownloadUrl($this->config['domain'][$this->type] . '/' . $re['key']);
        return $path;
    }

    /**
     * 多字段上传
     * @param Request $request
     * @param array $keys
     * @return array
     */
    public function uploadMany(Request $request, array $keys)
    {
        $qinPath = [];
        foreach ($keys as $key => $item) {
            $qinPath[$key][] = $this->uploadSingle($request, $item);
        }
        return $qinPath;
    }


    /**
     * 生成临时上传文件，为七牛做准备
     * @param Request $request
     * @param $uploadKey
     * @return array
     */
    public function dellWithImagePath(Request $request, $uploadKey)
    {
        $pathArray = array();
        if ($request->file($uploadKey)) {
            if (count($request->file($uploadKey)) > 0 && !is_object($request->file($uploadKey))) {
                foreach ($request->file($uploadKey) as $k => $item) {
                    list($pathArray[$k]['path'], $pathArray[$k]['key']) = $this->uploadToTemporaryAndGetTemporaryImageName($item);
                }
            } else {
                list($pathArray['path'], $pathArray['key']) = $this->uploadToTemporaryAndGetTemporaryImageName($request->file($uploadKey));
            }
        }
        return $pathArray;
    }

    /**
     * 上传到临时目录，并返回上传图片路径
     * @param $fileObj
     * @return array
     */
    public function uploadToTemporaryAndGetTemporaryImageName($fileObj)
    {
        $path = $fileObj->store($this->config['tem_path']);
        $arrayList[] = storage_path() . '/app/' . $path;
        $arrayList[] = str_replace('/', '', strrchr($path, '/'));
        return $arrayList;
    }

    /**
     * 删除上传临时目录
     */
    public function deleteDirTemPath()
    {
        $file =   $file = new Filesystem();
        $file->deleteDirectory(storage_path() . '/app/' . $this->config['tem_path']);
    }

}
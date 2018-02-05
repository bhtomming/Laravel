<?php
namespace App\Handlers;
use Image;

/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\2\5 0005
 * Time: 15:19
 */




class ImageUploadHandler
{
    protected $allowed_ext = ['jpg','png','gif','jpeg','bmp'];

    public function save($file, $folder, $file_prefix, $max_width=false){

        $folder_name = "upload/images/$folder/".date('Ymd',time());

        $upload_path = public_path().'/'.$folder_name;

        $extension = strtolower($file->getClientOriginalExtension())? : 'png';

        $fileName = $file_prefix.'_'.time().'_'.str_random(10).'.'.$extension;

        if(!in_array($extension,$this->allowed_ext)){
            return false;
        }

        $file->move($upload_path,$fileName);

        if($max_width && $extension != 'gif'){
            $this->reduceSize($upload_path.'/'.$fileName,$max_width);
        }

        return [
            'path' => config('app.url')."/$folder_name/$fileName",
        ];

    }

    public function reduceSize($file,$max_width){

        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file);

        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }

}
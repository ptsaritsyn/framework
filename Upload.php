<?php
/**
 * Created by PhpStorm.
 * Date: 12.12.2016
 * Time: 14:47
 */

namespace Framework;


class Upload
{
    /**
     * this method for upload files on server
     * @param $file_name
     * @param $dir_name
     */

    public static function upload($file_name, $dir_name)
    {
        move_uploaded_file($_FILES[$file_name]['tmp_name'], $dir_name.'/'.$_FILES[$file_name]['name']);
    }
}

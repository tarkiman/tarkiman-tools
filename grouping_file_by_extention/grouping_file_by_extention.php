<?php

$src = "D:\\SOURCES";

function recurse_rename($src)
{
    $destination_src = "D:\\DESTINATION";

    $dir = opendir($src);

    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                var_dump("SUB FOLDER >>> " . $src . '/' . $file);
                recurse_rename($src . '/' . $file);
            } else {

                $ext = "";
                $status = false;

                $ext4char = strtolower(substr($file, -5));

                if (
                    $ext4char == '.jpeg' ||
                    $ext4char == '.docx' ||
                    $ext4char == '.xlsx'
                ) {
                    $ext = $ext4char = strtolower(substr($file, -4));
                    $status = true;
                }

                $ext3char = strtolower(substr($file, -4));
                if (
                    $ext3char == '.jpg' ||
                    $ext3char == '.mp4' ||
                    $ext3char == '.mkv' ||
                    $ext3char == '.mov' ||
                    $ext3char == '.png' ||
                    $ext3char == '.3gp' ||
                    $ext3char == '.wmv' ||
                    $ext3char == '.avi' ||
                    $ext3char == '.gif' ||
                    $ext3char == '.pdf' ||
                    $ext3char == '.zip' ||
                    $ext3char == '.exe' ||
                    $ext3char == '.rar' ||
                    $ext3char == '.doc' ||
                    $ext3char == '.xls' ||
                    $ext3char == '.sql' ||
                    $ext3char == '.msi' ||
                    $ext3char == '.jwa'
                ) {
                    $ext = $ext3char = strtolower(substr($file, -3));
                    $status = true;
                }

                if ($status) {

                    $_file = $src . '/' . $file;

                    @mkdir($destination_src . "/" . $ext);

                    if (file_exists($destination_src . "/" . $ext . '/' . $file)) {
                        rename($_file, "E:\\DUPLICATE\\" . $file);
                    } else {
                        rename($_file, $destination_src . "/" . $ext . '/' .  $file);
                    }

                    var_dump(" FROM : " . $_file . " >>> MOVED TO : " . $destination_src . "/" . $ext . '/' .  $file);
                }
            }
        }
    }
    closedir($dir);
}

recurse_rename($src);

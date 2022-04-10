<?php

$src = "E:\\TMP";

function recurse_rename($src)
{
    $dir = opendir($src);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                var_dump(">>> " . $src . '/' . $file);
                recurse_rename($src . '/' . $file);
            } else {

                $ext = "";
                $status = false;

                $ext4char = strtolower(substr($file, -5));

                if ($ext4char == '.jpeg') {
                    $ext = $ext4char;
                    $status = true;
                }

                $ext3char = strtolower(substr($file, -4));
                if ($ext3char == '.jpg' || $ext3char == '.mp4' || $ext3char == '.mkv' || $ext3char == '.mov' || $ext3char == '.png' || $ext3char == '.3gp' || $ext3char == '.wmv' || $ext3char == '.avi' || $ext3char == '.gif') {
                    $ext = $ext3char;
                    $status = true;
                }

                if ($status) {

                    $_file = $src . '/' . $file;

                    $newFileName = date("Y-m-d_His", filemtime($_file)) . $ext;
                    if (file_exists($src . '/' . $newFileName)) {
                        // $newFileName = date("Y-m-d_His", filemtime($_file)) . '_0' . $ext;
                        rename($_file, "E:\\DUPLICATE\\" . date("Y-m-d_His", filemtime($_file)) . $ext);
                    } else {
                        $newFileName = date("Y-m-d_His", filemtime($_file)) . $ext;
                    }

                    var_dump($_file);
                    var_dump($src . '/' . $newFileName);

                    rename($_file, $src . '/' . $newFileName);
                }
            }
        }
    }
    closedir($dir);
}

recurse_rename($src);

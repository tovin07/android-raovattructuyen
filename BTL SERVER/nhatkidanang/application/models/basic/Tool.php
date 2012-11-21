<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tool
 *
 * @author QT-ThinkPad
 */
class Tool {

    public static function changeTitle($str) {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ',
            'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );
        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }
        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
        $str = str_replace("?", "", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("_", " ", $str);
        $str = str_replace("-", " ", $str);
        $str = str_replace("  ", " ", $str);
        $str = str_replace(",", " ", $str);
        $str = str_replace(".", " ", $str);
        $str = trim($str);
        $str = str_replace(" ", "-", $str);
        $str = str_replace("--", "-", $str);
        return $str;
    }

    public static function stripslashes_array(&$array, $iterations = 0) {
        if ($iterations < 3) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    Tool::stripslashes_array($array[$key], $iterations + 1);
                } else {
                    $array[$key] = stripslashes($array[$key]);
                }
            }
        }
    }

    public static function convertPrice($giaNhapVao) {
        $len = strlen($giaNhapVao);
        $gia = ".000";
        $i = 0;
        for ($i = 3; $i < $len; $i+=3) {

            $pos = -$i;

            $gia = "." . substr($giaNhapVao, $pos, 3) . $gia;
        }
        $i = $len - $i + 3;
        if ($i >= 0) {
            $gia = substr($giaNhapVao, -$len, $i) . $gia;
        }

        return $gia;
    }

    public static function createThumbImage($source, $destThumb, $destAvatar = null, $thumbWidth = 150, $thumbHeight = 0, $thumb_quality = 100) {
        $stype = substr($source, -3);
        $stype = strtolower($stype);
        switch ($stype) {
            case 'gif':
                $img = imagecreatefromgif($source);
                break;
            case 'jpg':
                $img = imagecreatefromjpeg($source);
                break;
            case 'png':
                $img = imagecreatefrompng($source);
                break;
        }

// load image and get image size
//        $img = imagecreatefromjpeg($source);
        $width = imagesx($img);
        $height = imagesy($img);

// calculate thumbnail size
        $new_width = $thumbWidth;
        if ($thumbHeight == 0)
            $new_height = floor($height * ( $thumbWidth / $width ));
        else
            $new_height = $thumbHeight;

// create a new temporary image
        $tmp_img = imagecreatetruecolor($new_width, $new_height);

// copy and resize old image into new image 
        imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// save thumbnail into a file
//        imagejpeg($img, $destAvatar, 90);
        return imagejpeg($tmp_img, $destThumb, $thumb_quality);
    }

    public static function rand_string($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }

}

?>

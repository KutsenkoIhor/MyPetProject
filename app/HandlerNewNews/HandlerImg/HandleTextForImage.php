<?php

namespace App\HandlerNewNews\HandlerImg;

class HandleTextForImage
{
    public static function start(string $str, int $maxLongString): array
    {
        $arr = explode(" ", $str);
        $newArr[0] = "";
        $i = 0;
        foreach ($arr as $value) {
            $testStr = $newArr[$i] . " " . $value;
            if (mb_strlen($testStr) < $maxLongString) {
                $newArr[$i] = $testStr;
            } else {
                $newArr[$i + 1] = $value;
                $i++;
            }
        }
        return $newArr;
    }
}

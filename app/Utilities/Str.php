<?php

namespace App\Utilities;

class Str
{
    /**
     * @param string $string
     * @param string $prefix
     * @return string
     */
    public static function prefixIfMissing(string $string, string $prefix): string
    {
        if(strpos($string, $prefix) !== 0) {
            $string = $prefix . $string;
        }
        return $string;
    }

    /**
     * @param string $string
     * @param string $suffix
     * @return string
     */
    public static function suffixIfMissing(string $string, string $suffix): string
    {
        $position = strlen($string) - strlen($suffix);
        if(strrpos($string, $suffix) !== $position) {
            $string .= $suffix;
        }
        return $string;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function sluggify(string $string): string
    {
        $search = ['ñ', 'á', 'é', 'í', 'ó', 'ú', ' ', '*', '%', '$', '#', '!', '?'];
        $replace = ['ni', 'a', 'e', 'i', 'o', 'u', '-', '', '', '', '', '', ''];
        return str_replace($search, $replace, $string);
    }
}
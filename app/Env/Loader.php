<?php

namespace App\Env;

class Loader
{
    /**
     * @var string
     */
    protected static $envFile;
    /**
     * @var array
     */
    protected static $variables = [];

    /**
     * @param string $path
     * @param string $filename
     */
    public static function cargar(string $path, string  $filename = ".env")
    {
        self::$envFile = $filename;
        $position = strlen($path) - strlen(DIRECTORY_SEPARATOR);
        if (strrpos($path,DIRECTORY_SEPARATOR) !== $position){
            $path .= DIRECTORY_SEPARATOR;
        }

        $fileContent = file($path . self::$envFile);
        
        foreach ($fileContent as $line){
            $line = trim($line);
            if ($line !== "" && strpos($line,'#') !== 0){
                $equalPos = strpos($line,"=");
                $name = substr($line,0,$equalPos);
                $value = substr($line,$equalPos + 1);
                self::$variables[$name] = $value;
            }
        }
    }

    /**
     * @param string $variable
     * @param null $default
     * @return mixed|null
     */
    public static function getValue(string $variable, $default = null)
    {
        return self::$variables[$variable] ?? $default;
    }
}
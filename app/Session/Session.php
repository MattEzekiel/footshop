<?php

namespace App\Session;

class Session
{
    public static function start()
    {
        session_start();
    }

    /**
     * @param string $key
     * @param $valor
     */
    public static function set(string $key,$valor)
    {
        $_SESSION[$key] = $valor;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key)
    {
        return self::has($key) ? $_SESSION[$key] : null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function has(string $key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @param string $key
     */
    public static function delete(string $key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public static function flash(string $key, $default = null)
    {
        if(!self::has($key)){
            return $default;
        }
        $valor = self::get($key);
        self::delete($key);
        return $valor;
    }
}
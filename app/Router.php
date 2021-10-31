<?php

namespace App;

class Router
{
    /** @var string */
    private $appPath;
    /** @var string */
    private $publicPath;
    /** @var string */
    private static $baseUrlPath;

    /** @var array[] */
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'PUT' => [],
        'DELETE' => [],
        'OPTIONS' => [],
    ];

    /**
     * @var array[]
     */
    private $parametrosRutas = [
        'GET' => [],
        'POST' => [],
        'PATCH' => [],
        'PUT' => [],
        'DELETE' => [],
        'OPTIONS' => [],
    ];

    /**
     * @var array
     */
    private static $parametros = [];

    /**
     * @param string $appPath
     */
    public function __construct(string $appPath)
    {
        $this->appPath = str_replace('\\', '/', $appPath);
        $this->publicPath = $this->appPath . "/public";
        $this->generarBaseUrlPath();
    }

    protected function generarBaseUrlPath()
    {
        $protocolo = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $host = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'] !== '80' ? ":" . $_SERVER['SERVER_PORT'] : '';

        $base = $protocolo . "://" . $host . $port;

        self::$baseUrlPath = str_replace($_SERVER['DOCUMENT_ROOT'], $base, $this->publicPath);
    }

    /**
     * @param string $route
     * @param Closure|array|string $fn
     */
    public function get(string $route, $fn)
    {
        if(strpos($route,'{') !== false){
            $this->parametrosRutas['GET'][$route] = $fn;
        } else {
            $this->routes['GET'][$route] = $fn;
        }
    }

    /**
     * @param string $route
     * @param Closure|array|string $fn
     */
    public function post(string $route, $fn)
    {
        if(strpos($route,'{') !== false){
            $this->parametrosRutas['POST'][$route] = $fn;
        } else {
            $this->routes['POST'][$route] = $fn;
        }
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $route = $this->parseUrlRoute($_SERVER['REQUEST_URI']);

        $this->runRoute($method,$route);
    }

    /**
     * @param string $metodo
     * @param string $ruta
     */
    protected function runRoute(string $metodo, string $ruta)
    {
        $fn = $this->routes[$metodo][$ruta] ?? null;

        if(!$fn){
            $fn = $this->buscarRutaParametrizada($metodo,$ruta);
        }

        if (is_null($fn)) {
            header('location: 404');
        } else {
            call_user_func($fn);
        }
    }

    /**
     * @param string $method
     * @param string $rutaRequerida
     * @return array|null
     */
    protected function buscarRutaParametrizada(string $method, string $rutaRequerida): ? array
    {
        foreach ($this->parametrosRutas[$method] as $ruta => $fn){
            $regex = $this->parameterizedToRegex($ruta);

            if(preg_match_all($regex,$rutaRequerida,$matches)){
                $this->setParametrosRutas($matches);
                return $fn;
            }
        }

        return null;
    }

    /**
     * @param string $ruta
     * @return string
     */
    protected function parameterizedToRegex(string $ruta) : string
    {
        $ruta = str_replace('/', '\\/',$ruta);
        preg_match_all('/{[^\/]+}+/', $ruta, $matches);

        foreach($matches[0] as $match) {
            $replace = substr($match, 1, -1);
            $ruta = str_replace($match, '(?<' . $replace . '>[^\/]+)', $ruta);
        }

        return '/^' . $ruta . '$/';
    }

    /**
     * @param array $matches
     */
    protected static function setParametrosRutas(array $matches)
    {
        $params = [];
        foreach($matches as $key => $match) {
            if(!is_int($key)) {
                $params[$key] = $match[0];
            }
        }
        self::$parametros = $params;
    }

    /**
     * @return array
     */
    public static function getRouteParameters(): array
    {
        return self::$parametros;
    }

    /**
     * @param string $url
     * @return string
     */
    protected function parseUrlRoute(string $url): string {
        $urlDocumentRoot = $_SERVER['DOCUMENT_ROOT'] . $url;
        return str_replace($this->publicPath, "", $urlDocumentRoot);
    }

    /**
     * @param string $path
     * @return string
     */
    public static function urlTo(string $path = ''): string
    {
        if(strpos($path,'/') !== 0){
            $path = '/' . $path;
        }

        return self::$baseUrlPath . $path;
    }

    /**
     * @param string $path
     * @return string
     */
    public static function redirect(string $path = ""): string
    {
        header('Location: ' .self::urlTo($path));
        exit;
    }
}

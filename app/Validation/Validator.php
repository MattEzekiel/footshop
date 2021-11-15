<?php

namespace App\Validation;

class Validator
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $reglas = [];

    /**
     * @var array
     */
    protected $errores = [];

    public function __construct(array $data, array $reglas)
    {
        $this->data = $data;
        $this->reglas = $reglas;

        $this->run();
    }

    public function run(): void
    {
        foreach ($this->reglas as $dataKey => $listaReglas) {
            $this->applyReglas($dataKey,$listaReglas);
        }
    }

    /**
     * @param string $dataKey
     * @param array $listaReglas
     * @throws \Exception
     */
    public function applyReglas(string $dataKey,array $listaReglas)
    {
        foreach ($listaReglas as $regla){
            if(strpos($regla,':') === false){
                $methodnombre = "_" . $regla;

                if(!method_exists($this,$methodnombre)){
                    throw new \Exception('No existe es regla de validación' . $regla . '.');
                }
                $this->{$methodnombre}($dataKey);
            } else {
                [$reglaNombre,$reglaParametro] = explode(':', $regla);

                $methodnombre = "_" . $reglaNombre;

                if(!method_exists($this,$methodnombre)){
                    throw new \Exception('No existe es regla de validación' . $regla . '.');
                }

                $this->{$methodnombre}($dataKey,$reglaParametro);
            }
        }
    }

    /**
     * @return bool
     */
    public function fails(): bool
    {
        return count($this->errores) > 0;
    }

    public function getErrores(): array
    {
        return $this->errores;
    }

    /**
     * @param string $key
     * @param string $mensaje
     */
    public function addError(string $key, string $mensaje): void
    {
        if (!isset($this->errores[$key])){
            $this->errores[$key] = [];
        }

        $this->errores[$key][] = $mensaje;
    }

    /**
     * @param string $key
     */
    public function _required(string $key)
    {
        $valor = $this->data[$key];
        if (empty($valor)){
            $this->addError($key, "El campo ". $key ." se encuentra vacío");
        }
    }

    /**
     * @param string $key
     * @param int $cuenta
     */
    public function _min(string $key, int $cuenta)
    {
        $valor = $this->data[$key];
        if (strlen($valor) < $cuenta){
            $this->addError($key, "El valor de ". $key ." debe tener al menos ". $cuenta . " caracteres");
        }
    }

    /**
     * @param string $key
     */
    public function _numeric(string $key)
    {
        $valor = $this->data[$key];
        if (!is_numeric($valor)){
            $this->addError($key, "El campo ". $key ." debe ser un número");
        }
    }
}
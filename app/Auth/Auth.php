<?php

namespace App\Auth;

use App\Models\Usuario;

class Auth
{
    /**
     * @var array
     */
    protected $credenciales = [];

    /**
     * @var Usuario|null
     */
    protected $usuario;

    /**
     * @param array $credenciales
     * @return bool
     */
    public function login(array $credenciales) : bool
    {
        $this->credenciales = $credenciales;

        $usuario = new Usuario();
        $this->usuario = $usuario->getByEmail($this->credenciales['email']);

        if($this->usuario === null){
            return false;
        }

        if(!password_verify($this->credenciales['password'], $this->usuario->getPassword())){
            return false;
        }

        $this->autenticar($this->usuario);
        return true;
    }

    public function logout() : void
    {
        unset($_SESSION['id_usuario']);
    }

    /**
     * @param Usuario $usuario
     */
    public function autenticar(Usuario $usuario) : void
    {
        $_SESSION['id_usuario'] = $usuario->getIdUsuario();
    }

    /**
     * @return bool
     */
    public function isAutenticado(): bool
    {
        return isset($_SESSION['id_usuario']);
    }

    /**
     * @return Usuario|null
     */
    public function getUsuario(): ? Usuario
    {
        if(!$this->isAutenticado()){
            return null;
        }

        if($this->usuario === null){
            $usuario = new Usuario();
            $this->usuario = $usuario->getByPk($_SESSION['id_usuario']);
        }

        return $this->usuario;
    }
}

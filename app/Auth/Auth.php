<?php

namespace App\Auth;

use App\Models\Usuario;
use App\Session\Session;

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
        Session::delete('id_usuario');
    }

    /**
     * @param Usuario $usuario
     */
    public function autenticar(Usuario $usuario) : void
    {
        Session::set('id_usuario', $usuario->getIdUsuario());
    }

    /**
     * @return bool
     */
    public function isAutenticado(): bool
    {
        return Session::has('id_usuario');
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
            $this->usuario = $usuario->getByPk(Session::get('id_usuario'));
        }

        return $this->usuario;
    }
}

<?php

namespace App\Models;

use App\DB\Connection;

class Usuario
{
    /**
     * @var int
     */
    protected $id_usuario;

    /**
     * @var string
     */
    protected $nombre;
    /**
     * @var string
     */
    protected $apellido;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $imagen;
    /**
     * @var string
     */
    protected $imagen_alt;
    /**
     * @var string
     */
    protected $remember_token;

    /**
     * @param string $email
     * @return Usuario|null
     */
    public function getByEmail(string $email): ? Usuario
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM usuarios
                   WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->execute([':email' => $email]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS,self::class);
        $usuario = $stmt->fetch();

        if(!$usuario){
            return null;
        }

        return $usuario;
    }

    /**
     * @param int $id
     * @return Usuario|null
     */
    public function getByPk(int $id): ?Usuario
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM usuarios
                  WHERE id_usuario = :id_usuario";
        $stmt = $db->prepare($query);
        $stmt->execute([':id_usuario' => $id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);

        $usuario = $stmt->fetch();

        return $usuario;
    }

    /**
     * @param array $datos
     * @return Usuario|null
     */
    public function crear(array $datos): ? Usuario
    {
        $db = Connection::getConnection();
        $query = "INSERT INTO usuarios (nombre, apellido, email, password)
                  VALUES (:nombre, :apellido, :email, :password)";
        $stmt = $db->prepare($query);
        $success = $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':apellido' => $datos['apellido'],
            ':email' => $datos['email'],
            ':password' => $datos['password'],
            ]);

        if (!$success){
            return null;
        }

        $usuario = new Usuario();
        $usuario->setIdUsuario($db->lastInsertId());
        $usuario->setEmail($datos['email']);
        $usuario->setPassword($datos['password']);

        return $usuario;
    }


    /**
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    /**
     * @param int $id_usuario
     */
    public function setIdUsuario(int $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido() : string
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getEmail() :string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getImagen() : string
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getImagenAlt() : string
    {
        return $this->imagen_alt;
    }

    /**
     * @param mixed $imagen_alt
     */
    public function setImagenAlt(string $imagen_alt): void
    {
        $this->imagen_alt = $imagen_alt;
    }

    /**
     * @return mixed
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRememberToken() : string
    {
        return $this->remember_token;
    }

    /**
     * @param mixed $remember_token
     */
    public function setRememberToken(string $remember_token): void
    {
        $this->remember_token = $remember_token;
    }
}

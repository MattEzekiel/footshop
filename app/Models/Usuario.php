<?php

namespace App\Models;

use App\DB\Connection;
use PDO;

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
    protected $remember_token;

    /**
     * @param string $email
     * @return Usuario|null
     */

    public function todo(array $buscar = []) : array
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM usuarios";
        $buscarValores = [];
        $queryValues = '';
        if (count($buscar) > 0){
            $buscarData = [];
            foreach ($buscar as $buscarItem){
                $buscarData[] = $buscarItem[0] . " " . $buscarItem[1] . " :" . $buscarItem[0];
                $buscarValores[$buscarItem[0]] = $buscarItem[2];
            }
            $queryValues = " WHERE " . implode(" AND ", $buscarData);
            $query .= $queryValues;
        }
        if ($this->pagination['pagination']){
            $this->queryPaginador($queryValues, $buscarValores);
            $query .= " LIMIT " . $this->pagination['offset'] . ', ' . $this->pagination['rows'];
        }
        $stmt = $db->prepare($query);
        $stmt->execute($buscarValores);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $stmt->fetchAll();
    }

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
     * @param int $pk
     * @param array $data
     * @return void
     */
    public function editar(int $pk, array $data)
    {
        $db = Connection::getConnection();
        $query = "UPDATE usuarios 
                  SET nombre = :nombre, apellido = :apellido, email = :email, password = :password
                  WHERE id_usuario = " . $pk;
        $stmt = $db->prepare($query);
        $stmt->execute([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    /**
     * @param int $rows
     * @return static
     */
    public function withPagination(int $rows): self
    {
        $this->pagination['pagination'] = true;
        $this->pagination['rows'] = $rows;
        $this->pagination['pageNow'] = (int) ($_GET['page'] ?? 1);
        $this->pagination['offset'] = ($rows * $this->pagination['pageNow']) - $rows;
        return $this;
    }

    /**
     * @param string $query
     * @param array $values
     */
    protected function queryPaginador(string $query = "", array $values = [])
    {
        $db = Connection::getConnection();
        $query = "SELECT COUNT(*) AS total FROM usuarios" . $query;
        $stmt = $db->prepare($query);
        $stmt->execute($values);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pagination['total'] = $resultado['total'];
        $this->pagination['pages'] = ceil($resultado['total'] / $this->pagination['rows']);
    }

    public function getPagination(): array
    {
        return $this->pagination;
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

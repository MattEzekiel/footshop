<?php

namespace App\Models;

use App\DB\Connection;

class Contacto extends Modelo
{
    protected $tabla = 'consultas';
    protected $primaryKey = 'id_consulta';
    protected $atributos = ['id_consulta','nombre','asunto','email','consulta','usuario_id'];
    protected $relaciones = [
        'n-1' => [
            Usuario::class => [
                'fk' => 'id_usuario',
                'prop' => 'nombre',
            ],
        ]
    ];


    /**
     * @var int
     */
    protected $id_consulta;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $asunto;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $consulta;

    /**
     * @param array $datos
     * @return bool|null
     */
    public function enviarConsulta(array $datos): ?bool
    {
        $db = Connection::getConnection();
        $query = "INSERT INTO consultas (nombre,asunto,email,consulta,usuario_id)
                    VALUES (:nombre,:asunto,:email,:consulta,:usuario_id)";
        $stmt = $db->prepare($query);
        $success = $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':asunto' => $datos['asunto'],
            ':email' => $datos['email'],
            ':consulta' => $datos['consulta'],
            ':usuario_id' => $datos['usuario_id'],
        ]);

        if(!$success){
            return null;
        }else{
            return true;
        }

    }

    /**
     * @return string
     */
    public function getAsunto(): string
    {
        return $this->asunto;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return int
     */
    public function getIdConsulta(): int
    {
        return $this->id_consulta;
    }

    /**
     * @return string
     */
    public function getConsulta(): string
    {
        return $this->consulta;
    }
}
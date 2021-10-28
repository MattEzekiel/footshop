<?php

namespace App\Models;

use App\DB\Connection;

class Contacto
{
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
}
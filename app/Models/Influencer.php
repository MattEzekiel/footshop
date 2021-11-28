<?php

namespace App\Models;

use App\DB\Connection;

class Influencer
{
    protected $id_influencer;
    protected $nombre;
    protected $oficio;
    protected $img;
    protected $img_alt;

    /**
     * @return array|null
     */
    public function todos() : ?array
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM influencers";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        $influencers =  $stmt->fetchAll();
        if(!$influencers){
            return null;
        }
        return $influencers;
    }

    /**
     * @return array
     */
    public function randomHome(): array
    {
        $db = Connection::getConnection();
        $query = "Select * FROM influencers
                    ORDER BY RAND() LIMIT 3";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    /**
     * @return int
     */
    public function getIdInfluencer(): int
    {
        return $this->id_influencer;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getOficio()
    {
        return $this->oficio;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @return mixed
     */
    public function getImgAlt()
    {
        return $this->img_alt;
    }
}
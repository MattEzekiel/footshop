<?php
namespace App\Files;

class SubirArchivo
{
    /**
     * @var array
     */
    protected $uploadedFile = [];

    /**
     * @var string
     */
    protected $filename;

    /**
     * @param array $file
     */
    public function __construct(array $file)
    {
        $this->uploadedFile = $file;
    }

    /**
     * @param $ruta
     * @return string
     */
    public function guardar($ruta): string
    {
        $this->filename = $this->generarNombreArchivo();
        $ext = pathinfo($this->uploadedFile['name'], PATHINFO_EXTENSION);
        $file = $this->filename . "-" . date('d-m-Y_H-m-s') . ".".$ext;
        move_uploaded_file($this->uploadedFile['tmp_name'], $ruta . "/" . $file);
        return $file;
    }
    
    /**
     * @return string
     */
    protected function generarNombreArchivo(): string
    {
        return preg_replace('/\\.[^.\\s]{3,4}$/', '',$this->uploadedFile['name']);
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }
}

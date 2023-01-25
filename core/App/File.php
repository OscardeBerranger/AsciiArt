<?php

namespace App;

class File
{

    private $uploadDirectory;
    private $fileData;
    private $extension;
    private $tempFile;
    private $name;
    private $target;
    private $mineType;
    private $acceptedMineType = ["image/jpeg", "image/png", "image/jpg"];

    public function __construct($index){
        $this->uploadDirectory = dirname(__DIR__, 2)."/image";  //Ici on séléctionne le fichier d'images

        $this->fileData = $_FILES[$index]; // on récupère toutes les données de l'image

        $this->extension = pathinfo($this->fileData['name'], PATHINFO_EXTENSION); //on récupère l'extension de l'image (.png / .jpeg / .jpg)

        $this->name = uniqid().".".$this->extension; // Génère un nom aléatoire pour l'image

        $this->target = $this->uploadDirectory.$this->name;
    }

    public function upload(){
        move_uploaded_file($this->tempFile, $this->target);
    }

    public function getName(): string{
        return $this->name;
    }

    public function isImage(){
        return in_array($this->mineType, $this->acceptedMineType);
    }

}
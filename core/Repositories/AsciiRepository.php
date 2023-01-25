<?php

namespace Repositories;

use Attributes\TargetEntity;

use Entity\Ascii;

#[TargetEntity(entityName: Ascii::class)]

class AsciiRepository extends AbstractRepository
{
    public function insert(Ascii $ascii){
        $request = $this->pdo->prepare("INSERT INTO {$this->tableName} SET nom = :nom, code = :code");


        $request->execute([
            "nom"=> $ascii->getNom(),
            "code"=>$ascii->getCode()
        ]);
    }

    public function update(Ascii $ascii){
        $requete = $this->pdo->prepare("UPDATE {$this->tableName} SET code = :code, nom= :nom WHERE id = :id");
        $requete->execute([
            'id'=>$ascii->getId(),
            'nom'=>$ascii->getNom(),
            'code'=>$ascii->getCode()
        ]);
    }
}
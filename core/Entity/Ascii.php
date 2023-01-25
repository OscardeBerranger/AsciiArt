<?php

namespace Entity;


use Attributes\Table;
use Attributes\TargetRepository;
use Repositories\AsciiRepository;

#[Table(name: "mainAscii")]
#[TargetRepository(repositoryName: AsciiRepository::class)]

class Ascii extends AbstractEntity
{

    private int $id;
    private string $nom;
    private string $code;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->title = $nom;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
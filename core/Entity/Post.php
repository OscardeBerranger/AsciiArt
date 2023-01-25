<?php

namespace Entity;


use Attributes\Table;
use Attributes\TargetRepository;
use Repositories\PostRepository;

#[Table(name: "posts")]
#[TargetRepository(repositoryName: PostRepository::class)]

class Post extends AbstractEntity
{



    private int $id;
    private string $title;
    private string $content;


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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

}
<?php

namespace Entity;

use Attributes\DefaultEntity;
use Attributes\Table;
use Attributes\TargetRepository;
use Repositories\CommentRepository;

require_once ('core/Entity/AbstractEntity.php');

#[Table(name: "comments")]
#[TargetRepository(repositoryName: CommentRepository::class)]
class Comment extends AbstractEntity
{


    private int $id;
    private string $content;
    private int $post_id;



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

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->post_id;
    }

    /**
     * @param int $post_id
     */
    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
    }
}
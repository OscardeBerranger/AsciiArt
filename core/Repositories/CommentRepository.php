<?php

namespace Repositories;

use Attributes\TargetEntity;
use Entity\Comment;
use Entity\Post;
#[TargetEntity(entityName: Comment::class)]
class CommentRepository extends AbstractRepository
{

    public function findAllByPost(Post $post){
        $query= $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE post_id=:post_id");

        $query->execute(["post_id"=>$post->getId()]);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_class($this->targetEntity));

        $comments = $query->fetchAll();
        return $comments;
    }

    public function insert(Comment $comment){
        $request = $this->pdo->prepare("INSERT INTO {$this->tableName} SET post_id = :post_id, content = :content");


        $request->execute([
            "post_id"=> $comment->getPostId(),
            "content"=>$comment->getContent()
        ]);
    }

    public function update(Comment $comment){
        $requete = $this->pdo->prepare("UPDATE {$this->tableName} SET content = :content WHERE id = :id");
        $requete->execute([
            'id'=>$comment->getId(),
            'content'=>$comment->getContent(),
        ]);
    }
}
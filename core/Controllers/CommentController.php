<?php

namespace Controllers;

use Attributes\DefaultEntity;
use Entity\Comment;
use Entity\Post;

#[DefaultEntity(entityName: Comment::class)]

class CommentController extends AbstractController
{
//    protected string $defaultEntityName = Comment::class;

    public function create(){

        $postId = null;
        $content = null;

        if(!empty($_POST['post_id']) && ctype_digit($_POST['post_id'])){
            $postId = $_POST['post_id'];
        }
        if(!empty($_POST['content'])){
            $content = htmlspecialchars($_POST['content']);
        }

        if($postId && $content){

            $postEntity = new Post();

            $post = $this->getRepository(Post::class)->findById($postId);

            if(!$post){
                return $this->redirect();
            }

            $comment = new Comment();
            $comment->setContent($content);
            $comment->setPostId($postId);

            $this->repository->insert($comment);

            return $this->redirect([
                "type"=>"post",
                "action"=>"show",
                "id"=>$post->getId()
            ]);



        }



    }

    public function remove(){

        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
           $id = $_GET['id'];
        }

        if(!$id){  return $this->redirect(); }

        $comment = $this->repository->findById($id);

        if(!$comment){  return $this->redirect(); }

        $this->repository->delete($comment);

        return $this->redirect([
            "type"=>"post",
            "action"=>"show",
            "id"=>$comment->getPostId()
        ]);


    }

    public function change(){



        $id = null;
        $content = null;

        if(!empty($_POST['id']) && ctype_digit($_POST['id'])){
            $id = $_POST['id'];
        }

        if(!empty($_POST['content'])){
            $content = htmlspecialchars($_POST['content']);
        }

        if($id && $content){

            $comment = $this->repository->findById($id);

            if(!$comment){  return $this->redirect(); }

            $comment->setContent($content);

            $this->repository->update($comment);

            return $this->redirect([
                "type"=>"post",
                "action"=>"show",
                "id"=>$comment->getPostId()
            ]);

        }


        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $id = $_GET['id'];
        }

        if(!$id){  return $this->redirect(); }

        $comment = $this->repository->findById($id);

        if(!$comment){  return $this->redirect(); }


        return $this->render('comments/update', [
            "comment"=>$comment,
            "pageTitle"=> "Modifier votre comment"
        ]);

    }

}
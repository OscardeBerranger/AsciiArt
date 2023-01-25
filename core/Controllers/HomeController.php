<?php

namespace Controllers;

use Attributes\DefaultEntity;
use Entity\Post;
#[DefaultEntity(entityName: Post::class)]
class HomeController extends AbstractController
{

    public function index(){
        $infosImage = null;

        if (!empty($_FILES['monImage'])){
            $infosImage = $_FILES['monImage'];
        };

        var_dump($infosImage);

        return $this->render("home/index", ["pageTitle"=>"home"]);
    }

}
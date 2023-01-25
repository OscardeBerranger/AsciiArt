<?php
namespace Controllers;
use App\File;
use Attributes\DefaultEntity;
use Entity\Ascii;


#[DefaultEntity(entityName: Ascii::class)]

class AsciiController extends AbstractController{
    protected string $defaultEntityName = Ascii::class;

    public function index(){
        return $this->render("ascii/index", [
            "ascii"=>$this->repository->findAll(),
            "pageTitle"=>"accueil du blog"
        ]);
    }

    public function show(){
        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id']) ){
            $id = $_GET['id'];
        }

        if(!$id){ return $this->redirect(); }


        $ascii = $this->repository->findById($id);

        if(!$ascii){ return $this->redirect();}


        return $this->render("ascii/ascii", [
            "ascii"=>$ascii,
            "pageTitle"=>$ascii->getNom()
        ]);
    }

    public function remove(){

        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id']) ){
            $id = $_GET['id'];
        }
        if($id){
            $ascii = $this->repository->findById($id);
        }

        if($ascii){

            $this->repository->delete($ascii);

        }

        // reparer ca la juste en dessous

        return $this->redirect();
    }

    public function create(){
        $nom = null;
        $code = null;
        if (!empty($_POST['nom'])){
            $nom = $_POST['nom'];
        }
        if (!empty($_POST['code'])){
            $code = $_POST['code'];
        }

        if ($nom && $code){
            $ascii = new Ascii();

            $ascii->setNom($nom);

            $ascii->setCode($code);

            $this->repository->insert($ascii);

            return $this->redirect();
        }
        return $this->render("ascii/ascii", ["pageTitle"=>"nouveau ascii"]);

    }
}
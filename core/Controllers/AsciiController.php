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


        return $this->render("ascii/asciiShow", [
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

    public function change(){
        $nom = null;
        $id = null;

        if(!empty($_POST['id']) && ctype_digit($_POST['id']) ){
            $id = $_POST['id'];
        }
        if($id){
            $ascii = $this->repository->findById($id);
            if(!$ascii){
                return $this->redirect();
            }
        }

        if (!empty($_POST['nom'])){
            $nom = $_POST['nom'];
        }
        if ($nom && $id){
            $ascii = $this->repository->findById($id);

            $ascii->setNom($nom);
            $ascii->setId($id);
            $this->repository->update($ascii);

            return $this->redirect([
                "type" => "ascii",
                "action"=>"show",
                "id"=>$ascii->getId()
            ]);
        }
        return $this->render("ascii/asciiShow",
            ["ascii"=>$ascii,
                "pageTitle"=>"modifier le post"]);
    }
}
<?php
require_once "../vendor/autoload.php";

class Client{
    private $nom;
    public function getNom(){
        $this->nom = "haddock";
        return ($this->nom);
    }

}
$data = new Client();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__."/views/");
$envTwig = new \Twig\Environment($loader);

echo $envTwig->render(
    "monTemplate.html.twig", [
    'msg'=> $data]
);
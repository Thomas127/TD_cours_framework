<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

#[Route("/img")]
class ImageController extends AbstractController
{
    #[Route("/home", name:"img_home")]
    function home(){
        return $this->render("img/home.html.twig");
    }

    #[Route("/data/{parametre}", name:"img_affiche")]
    function affiche($parametre){
        
        $path = __DIR__."/../../images/".$parametre.".jpg";

        if (!file_exists($path)){
            return new Response("L'image n'est pas disponible");
        }
        $binary_response = $this->file($path, null, ResponseHeaderBag::DISPOSITION_INLINE); //ENLEVER DISPOSITION INLINE POUR LE TELECHARGEMENT
        $binary_response->headers->set('Content-Type', 'image/jpg');

        return $binary_response;
        
    }

    
    #[Route("/menu", name:"menu_images")]
    function menu(){
        $path = __DIR__."/../../images/";
        $files = scandir($path);
        $images = [];
        foreach ($files as $file){
            $full_path = $path.$file;
            if (!is_dir($full_path)){
                $images[] = pathinfo($file, PATHINFO_FILENAME);
            }
        }
        
        return $this->render('img/menu.html.twig', ['images' => $images]);
    }

}

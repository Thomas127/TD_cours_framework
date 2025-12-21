<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

class AuthController extends AbstractController
{
    #[Route("/login", name: "auth_login")]
    public function login(Request $request){
        $builder = $this->createFormBuilder();
        $contrainte = new NotBlank();

        $builder->add('email', TextType::class, [
            'constraints' => $contrainte
        ])
            ->add('btsubmit', SubmitType::class);

        $form = $builder->getForm();
        $infoRendu = $form->createView();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            return $this->render("authok.html.twig", ['data' => $form->getData()]);
        }
        else{
            return $this->render("login.html.twig", ['infoform'=> $infoRendu]);
        }

    }
}
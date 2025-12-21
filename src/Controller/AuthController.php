<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AuthController extends AbstractController
{
    #[Route("/login", name: "auth_login")]
    public function login(Request $request){
        $builder = $this->createFormBuilder();
        $contrainte = new NotBlank();
        
        $builder
            ->add('email', TextType::class, ['constraints' => $contrainte])
            ->add('password', PasswordType::class, ['constraints' => $contrainte])
            ->add('Confirmer_password', PasswordType::class, ['constraints' => $contrainte])
            ->add('btsubmit', SubmitType::class);

        $form = $builder->getForm();
        $infoRendu = $form->createView();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            if ($data['password'] !== $data['Confirmer_password']) {
                return $this->render("login.html.twig", ['infoForm'=> $infoRendu]);
            }
            return $this->render("authok.html.twig", ['email' => $email]);
        }
        else{
            return $this->render("login.html.twig", ['infoForm'=> $infoRendu]);
        }
    }

    /*#[Route("/confirmation/{email}", name: "auth_confirmation")]
    public function confirmation(string $email){
        return $this->render("authok.html.twig", ['email' => $email]);
    }*/
}
<?php

namespace App\Controller;
session_name("Authentification");
session_start();

$_SESSION['auth'] = false;
$_SESSION['nbr'] = 0;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AuthController extends AbstractController
{
    #[Route("/login", name: "auth_login")]
    public function login(Request $request){
        $builder = $this->createFormBuilder();
        $contrainte = new NotBlank();

        $passwordRegex = new Regex([
            'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#_-])[A-Za-z\d@$!%*?&#_-]{8,}$/',
            'message' => 'Password must be compose with at least 8 chars, 1 maj, 1 min, and 1 number et special chars'
        ]);

        $passwordContrainte = new Callback(function($value, ExecutionContextInterface $context) {
            $form = $context->getRoot();
            $password = $form->get('password')->getData();
                    
            if ($value !== $password) {
                $context->buildViolation('Password are incorrect.')
                        ->addViolation();
                }
        });

        $builder
            ->add('email', TextType::class, ['constraints' => $contrainte])
            ->add('password', PasswordType::class, ['constraints' => [$contrainte, $passwordRegex]])
            ->add('Confirmer_password', PasswordType::class, ['constraints' => [$contrainte, $passwordContrainte]])
            ->add('btsubmit', SubmitType::class);

        $form = $builder->getForm();
        

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            if ($data['password'] !== $data['Confirmer_password']) {
                
                $infoRendu = $form->createView();
                return $this->render("login.html.twig", ['infoForm'=> $infoRendu]);
            }
            return $this->forward('App\Controller\AuthController::confirmation', ['data' => $data]);
        }
        else{
            $infoRendu = $form->createView();
            return $this->render("login.html.twig", ['infoForm'=> $infoRendu]);
        }
    }

    #[Route("/authenficate", name: "auth_confirmation")]
    public function confirmation(array $data){
        $_SESSION['auth'] = true;
        $_SESSION["login"] = $data["email"];
        $_SESSION["password"] = $data["password"];

        return $this->render("authok.html.twig", ['email' => $data["email"]]);
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\Type\SignUpType;
use App\Form\Type\LoginType;

class AuthController extends AbstractController
{   
    
    public function Verif_connecter(SessionInterface $session){
        // Initialiser la session si ce n'est pas fait
        if ($session->has('auth')) {
            $isconnect = $session->get('auth', false);

            if ($isconnect){
                $user = array(
                    'auth' => $session->get('auth', false),
                    'login' => $session->get('login', ''),
                    'password'=> $session->get('password', '')
                );
                return $this->render("private_auth.html.twig", ['session'=> $user]);
            }
        }
        
        return $this->render("base.html.twig");
    }

    #[Route("/home", name: "home")]
    public function home(SessionInterface $session){
        // Initialiser la session si ce n'est pas fait
        if (!$session->has('auth')) {
            $session->set('auth', false);
            $session->set('nbr', 0);
        }
        
        return $this->render("base.html.twig");
    }

    #[Route("/sign_up", name: "auth_sign_in")]
    public function sign_in(Request $request, SessionInterface $session){

        $dataEntity = new User();

        $form = $this->createForm(SignUpType::class, $dataEntity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $dataEntity = $form->getData();
            if ($dataEntity->getPassword() !== $dataEntity->getConfirmPassword()) {
                
                $infoRendu = $form->createView();
                return $this->render("form.html.twig", ['infoForm'=> $infoRendu]);
            }
            
            
            return $this->forward('App\Controller\AuthController::confirmation', ['data' => $dataEntity]);
        }
        else{
            $infoRendu = $form->createView();
            return $this->render("form.html.twig", ['infoForm'=> $infoRendu]);
        }
    }

    #[Route("/login", name: "auth_login")]
    public function login(Request $request, SessionInterface $session){

        $dataEntity = new User();
        $form = $this->createForm(LoginType::class, $dataEntity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $dataEntity = $form->getData();
            
            
            $login = $session->get('login', '');
            $password = $session->get('password', '');

            if ($password === $dataEntity->getPassword())
            {
                $session->set('auth', true);
                $user = array(
                    'auth' => $session->get('auth', false),
                    'login' => $session->get('login', ''),
                    'password'=> $session->get('password', '')
                );
                return $this->render("private_auth.html.twig", ['session'=> $user]);
            }
            else
            {
                $this->addFlash('error', 'Email ou mot de passe incorrect');
                $infoRendu = $form->createView();
                return $this->render("form.html.twig", ['infoForm'=> $infoRendu]);
            }
            
        }
        else{
            $infoRendu = $form->createView();
            return $this->render("form.html.twig", ['infoForm'=> $infoRendu]);
        }
    }

    #[Route("/authentificate", name: "auth_confirmation")]
    public function confirmation(User $data, SessionInterface $session){
        $session->set('auth', false);
        $session->set('login', $data->getEmail());
        $session->set('password', $data->getPassword());

        return $this->render("authok.html.twig", ['email' => $data->getEmail()]);
    }
    
}
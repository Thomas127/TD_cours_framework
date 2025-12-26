<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
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
            ->add('email', TextType::class, ['constraints' => [$contrainte]])
            ->add('password', PasswordType::class, ['constraints' => [$contrainte, $passwordRegex]])
            ->add('ConfirmPassword', PasswordType::class, ['constraints' => [$contrainte, $passwordContrainte]])
            ->add('btsubmit', SubmitType::class);

        
    }
}
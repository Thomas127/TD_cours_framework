<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    protected $email;

    #[ORM\Column(type: 'string', length: 255)]
    protected $password;

    // Cette propriété ne doit pas être persistée en base
    protected $ConfirmPassword;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getConfirmPassword()
    {
        return $this->ConfirmPassword;
    }

    public function setConfirmPassword($password)
    {
        $this->ConfirmPassword = $password;
        return $this;
    }
}
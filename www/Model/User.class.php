<?php

namespace App\Model;

use App\Core\DatabaseDriver;

class User extends DatabaseDriver
{

    private $id;
    protected $firstname;
    protected $lastname;
    protected $birthday;
    protected $email;
    protected $pwd;
    protected $confirmation;

    public function __construct()
	{
		parent::__construct();
	}


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(Int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstname;
    }

    public function setFirstName(String $firstname): void
    {
        $this->firstname = strip_tags($firstname);
    }

    public function getLastName(): ?string
    {
        return $this->lastname;
    }

    public function setLastName(String $lastname): void
    {
        $this->lastname = strip_tags($lastname);
    }

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(String $birthday): void 
    {
        $this->birthday = $birthday;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(String $email): void
    {
        $this->email = mb_strtolower(trim($email));
    }

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(String $pwd): void
    {
        $this->pwd = $pwd;
    }

    public function getConfirmation(): ?int
    {
        return $this->confirmation;
    }

    public function setConfirmation(Int $confirmation): void 
    {
        $this->confirmation = $confirmation;
    }

    public function registerForm(){
        return [
                "config" => [
                                "method"=>"POST",
                                
                            ],
                "inputs"=> [
                    "firstname"=>[
                                    "type"=>"text",
                                    "placeholder"=>"Votre prénom",
                                    "min"=>2,
                                    "max"=>30,
                                    "required"=>true,
                                    "error"=>"Votre prénom doit faire entre 2 et 30 caractères et ne doit pas contenir de chiffre"
                                ],

                    "lastname"=>[
                                    "type"=>"text",
                                    "placeholder"=>"Votre nom de famille",
                                    "min"=>2,
                                    "max"=>30,
                                    "required"=>true,
                                    "error"=>"Votre nom doit faire entre 2 et 30 caractères et ne doit pas contenir de chiffre"
                                ],

                    "birthday"=>[
                                    "type"=>"date",
                                    "placeholder"=>"Votre date de naissance",
                                    "required"=>true,
                                    "error"=>"Entrez une date de naissance réaliste"
                                ],
                    "mail"=>[
                                    "type"=>"email",
                                    "placeholder"=>"Votre email",
                                    "required"=>true,
                                    "error"=>"Votre email est incorrect"
                                ],
                    "pwd"=>[
                                    "type"=>"password",
                                    "placeholder"=>"Votre mot de passe",
                                    "required"=>true,
                                    "error"=>"Votre mot de passe doit faire plus de 8 caractères avec une minuscule une majuscule et un chiffre"
                                ],
                    "pwdconfirm"=>[
                                    "type"=>"password",
                                    "placeholder"=>"Confirmation de mot de passe",
                                    "required"=>true,
                                    "confirm"=>"pwd",
                                    "error"=>"Votre mot de passe de confirmation ne correspond pas"
                                ],
                    "inscription"=>    [
                                    "type"=>"submit",
                                    "value"=>"S'inscrire",
                                    
                    ],

                            ],
                
            ];
    }

    

    public function loginForm(){
        return [
                "config" => [
                                "method"=>"POST",
                                
                            ],
                "inputs"=> [
                    
                    "mail"=>[
                                    "type"=>"email",
                                    "placeholder"=>"Votre email",
                                    "required"=>true,
                                    "error"=>"Votre email est incorrect"
                                ],
                    "pwd"=>[
                                    "type"=>"password",
                                    "placeholder"=>"Votre mot de passe",
                                    "required"=>true,
                                    "error"=>"Votre mot de passe est incorrect"
                                ],
                    "login"=>    [
                                    "type"=>"submit",
                                    "value"=>"Se connecter",
                                    
                    ],

                            ],
                
            ];
    }

    public function updateForm($tabUser){
        return [
                "config" => [
                                "method"=>"POST",
                                
                            ],
                "inputs"=> [
                    "firstname"=>[
                                    "type"=>"text",
                                    "placeholder"=>"Votre prénom",
                                    "min"=>2,
                                    "max"=>30,
                                    "required"=>true,
                                    "value"=>$tabUser['firstname'],
                                    "error"=>"Votre prénom doit faire entre 2 et 30 caractères et ne doit pas contenir de chiffre"
                                ],

                    "lastname"=>[
                                    "type"=>"text",
                                    "placeholder"=>"Votre nom de famille",
                                    "min"=>2,
                                    "max"=>30,
                                    "required"=>true,
                                    "value"=>$tabUser['lastname'],
                                    "error"=>"Votre nom doit faire entre 2 et 30 caractères et ne doit pas contenir de chiffre"
                                ],

                    "birthday"=>[
                                    "type"=>"date",
                                    "placeholder"=>"Votre date de naissance",
                                    "required"=>true,
                                    "value"=>$tabUser['birthday'],
                                    "error"=>"Entrez une date de naissance réaliste"
                                ],
                    "mail"=>[
                                    "type"=>"email",
                                    "placeholder"=>"Votre email",
                                    "required"=>true,
                                    "value"=>$tabUser['email'],
                                    "error"=>"Votre email est incorrect"
                                ],
                    "pwd"=>[
                                    "type"=>"password",
                                    "placeholder"=>"Votre nouveau mot de passe",
                                    "required"=>true,
                                    "error"=>"Votre mot de passe doit faire plus de 8 caractères avec une minuscule une majuscule et un chiffre"
                                ],
                    "pwdconfirm"=>[
                                    "type"=>"password",
                                    "placeholder"=>"Confirmation de votre nouveau mot de passe",
                                    "required"=>true,
                                    "confirm"=>"pwd",
                                    "error"=>"Votre mot de passe de confirmation ne correspond pas"
                                ],
                    "updateUser"=>    [
                                    "type"=>"submit",
                                    "value"=>"Mettre à jour",
                                    
                    ],

                            ],
                
            ];
    }
}


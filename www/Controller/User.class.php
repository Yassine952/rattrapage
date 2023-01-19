<?php

namespace App\Controller;
use App\Core\View;
use App\Core\Verificator;
use App\Core\Security;
use App\Core\Mailer;
use App\Model\User as Users;


class User{


    public function register(): void
        {
            $user = new Users();
            $registerForm = $user->registerForm();
        
            

            if(!empty($_POST['inscription'])){
                $verificator = new Verificator($registerForm, $_POST);
                $configRegisterFormErrors = $verificator->getMsg();
                if(empty($configRegisterFormErrors)){	
                    $user->setEmail($_POST['mail']);
                    

                   if(!$user->findUserByEmail($user->getEmail())){	
                        $user->setFirstName($_POST['firstname']);
                        $user->setLastName($_POST['lastname']);
                        $user->setBirthday($_POST['birthday']);
                        $user->setPwd(password_hash($_POST['pwd'],PASSWORD_DEFAULT));
                        $user->setConfirmation(0);
                        $user->save(); 
                        
                        $userid = $user->findRow("email",$user->getEmail());
                        $security = new Security();
                        $security->createJWT([$userid["id"], $user->getFirstname(), $user->getLastname(), $user->getEmail(), $user->getBirthday(), $user->getConfirmation()]);
                        setcookie("jwt",$security->getToken(), $security->getExpireClaim());
                        $mailer = new Mailer();
                        $mailer->send($user->getEmail(), $user->getFirstname(),$security->getToken());

                        
                   }
                   else {
                    $configRegisterFormErrors[] = "Email déjà utilisée";

                   }  
                }                
            }
            
            $loginForm = $user->loginForm();
            
            if(!empty($_POST['login'])){  

                $verificator = new Verificator($loginForm, $_POST);
                $configLoginFormErrors = $verificator->getMsg();

                if(empty($configLoginFormErrors)){
                    $user->setEmail($_POST['mail']);
                    $user_data = $user->findUserByEmail($user->getEmail());
                   

                    if($user_data && password_verify($_POST['pwd'],$user_data['pwd'])){
                        
                        $user->setId($user_data['id']);
                        $user->setFirstname($user_data['firstname']);
                        $user->setLastname($user_data['lastname']);
                        $user->setBirthday($user_data['birthday']);
                        $user->setConfirmation($user_data['confirmation']);
                        $security = new Security();
                        $security->createJWT([$user_data['id'], $user->getFirstname(), $user->getLastname(), $user->getEmail(), $user->getBirthday(),$user_data['confirmation']]);
                        setcookie("jwt",$security->getToken(), $security->getExpireClaim());
                        header("Location: /user");
                        
                    }
                    else{
                        $configLoginFormErrors[] = "Email ou mot de passe incorrect";
                    }
                }
            }

            



            $v = new View("Page/Home");
            $v->assign("registerForm",$registerForm);
            $v->assign("loginForm",$loginForm);    
           
            
            $v->assign("configRegisterFormErrors",$configRegisterFormErrors??[]);
            $v->assign("configLoginFormErrors",$configLoginFormErrors??[]);

           
        }

    public function logout(): void{
        setcookie("jwt", "", time() - 1800);
        header("Location: /");
    }

    public function allUser(): void {

        $update = false;
        
        $user = new Users();
        $users = $user->findAll();

        $security = new Security();
        


        if(isset($_GET['email']) && $_GET['token']){
            $email = $_GET['email'];
            $token = $_GET['token'];
            $decodedUrlJWT = $security->decodeJWT($token);
            $user_data = $user->findUserByEmail($email);

            if(isset($email) && !empty($email && isset($token) && !empty($token))){
                if($email = $decodedUrlJWT["payload"]["3"]){
                    $user->setId($decodedUrlJWT["payload"]["0"]);
                    $user->setFirstName($decodedUrlJWT["payload"]["1"]);
                    $user->setLastName($decodedUrlJWT["payload"]["2"]);
                    $user->setEmail($decodedUrlJWT["payload"]["3"]);
                    $user->setBirthday($decodedUrlJWT["payload"]["4"]);
                    $user->setPwd($user_data['pwd']);
                    $user->setConfirmation(1);
                    $user->save();

                    header("Location: /user");
                }
               
                
            }   
           
        }
        $decodedJWT = $security->decodeJWT($_COOKIE['jwt']);

        if(!$_COOKIE["jwt"] || $decodedJWT["payload"]["5"] == 0){
            
            header("Location: /");
            echo "Veuillez confirmer votre email"; 
      
        }

        // Update

        if(isset($_GET['modify'])){
            $id = $_GET['modify'];
            
            if($decodedJWT["payload"][0]==$id){
                header("Location: /user");
            }else{
            
                $update = true;
                
                
                $tabUser = $user->findRow('id', $id);
                $updateForm = $user->updateForm($tabUser);
                if(!empty($_POST['updateUser'])){
                    $verificator = new Verificator($updateForm, $_POST);
                    $configUpdateFormErrors = $verificator->getMsg();

                    if(empty($configUpdateFormErrors)){
                        $user->setEmail($_POST['mail']);
                    
                        if(!$user->findUserByEmail($user->getEmail()) || $tabUser["email"] == $_POST["mail"]){	
                            $user->setId($id);
                            $user->setFirstName($_POST["firstname"]);
                            $user->setLastName($_POST["lastname"]);
                            $user->setBirthday($_POST['birthday']);
                            $user->setPwd(password_hash($_POST['pwd'],PASSWORD_DEFAULT));
                            $user->setConfirmation($tabUser["confirmation"]);
                            $user->save();
                            header("Location: /user");
                        }
                        else {
                            $configUpdateFormErrors[] = "Email déjà utilisée";
        
                           }  


                    }
                }
            }
        }

        $v = new View("Page/User");
        $v->assign("users",$users);
        $v->assign("update",$update);
        $v->assign("updateForm",$updateForm??[]);
        $v->assign("configUpdateFormErrors",$configUpdateFormErrors??[]);
        $v->assign("tabUser",$tabUser??"");
        $v->assign("decodedJWT",$decodedJWT);


    
    }
    
    public function deleteUsers(){

        $user = new Users();
        

        $security = new Security();
        $decodedJWT = $security->decodeJWT($_COOKIE['jwt']);

        if (isset($_GET['del'])){
			$id = $_GET['del'];
            
            if($decodedJWT["payload"][0]==$id){
                header("Location: /user");
            }
            else{
			$user->delete('id',$id);
            
            }
		}
        header("Location: /user");

    }
    
  


}
<?php

namespace App\Core;


use App\vendor\phpmailer\PHPMailer;
use App\vendor\phpmailer\SMTP;
use App\vendor\phpmailer\Exception;


class Mailer {

    public function send(String $email, String $username, String $tokenmail): void
    {
        $HOST = "smtp.office365.com";
        $USERNAME = "rattrapagephpyassine@outlook.fr";
        $PASSWORD = "0123456bba";
        $PORT = 587;
        $SECURE = "STARTTLS";

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = $HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = $USERNAME;
                    //SMTP username
            $mail->Password   = $PASSWORD;
            $mail->SMTPSecure = $SECURE;
            $mail->Port       = $PORT;

            //Recipients
            $mail->setFrom('rattrapagephpyassine@outlook.fr', 'rattrapageyassine');
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Inscription pour le rattrapage de yassine';
            $mail->Body    = 'Merci beaucoup pour votre inscription ! ' . '<b>' . $username  .'</b><br><a href=http://localhost/user?email='.$email.'&token='. $tokenmail .  '>Veuillez cliquez ici pour confirmer votre adresse mail</a>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//            die();
        }
    }
}
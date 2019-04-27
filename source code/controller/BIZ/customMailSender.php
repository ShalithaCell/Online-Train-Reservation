<?php


class customMailSender
{
    function sendMail($objMailContent){
        require '../../Config/phpmailer/PHPMailerAutoload.php';


        $credential = include('../../Config/credential.php');   //credentials import

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $credential['user']  ;           // SMTP username
        $mail->Password = $credential['pass']  ;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom($credential['user'], 'BOOKit');
        $mail->addAddress($objMailContent->getReceverAddress());             // Name is optional

        $mail->addReplyTo($credential['user'], 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $objMailContent->getSubject();
        $mail->Body    = $objMailContent->getBody();
        $mail->AltBody = 'If you see this mail. please reload the page.';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo true;
        }
    }
}

?>
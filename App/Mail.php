<?php

namespace App;

use App\Config;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';


/**
 * Mail
 *
 * PHP version 7.0
 */
class Mail
{

    /**
     * Send a message
     *
     * @param string $to Recipient
     * @param string $subject Subject
     * @param string $text Text-only content of the message
     * @param string $html HTML content of the message
     *
     * @return mixed
     */
    public static function send($to, $subject, $text, $html)
    {

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = 2;
        //$mail->Debugoutput = 'html';
        $mail->isSMTP();
        $mail->Host = Config::MAIL_HOST;
        $mail->SMTPAuth = Config::MAIL_HOST_AUTHENTICATION;
        $mail->Username = Config::MAIL_USERNAME;
        $mail->Password = Config::MAIL_PASSWORD;
        $mail->SMTPSecure = Config::MAIL_SMTP_SECURE_TYPE;
        $mail->Port = Config::MAIL_SMTP_PORT;
        $mail->SMTPOptions = Config::MAIL_SMTP_OPTIONS;
        // $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;

        $mail->setFrom(Config::MAIL_USERNAME, Config::MAIL_SENDER_NAME);
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $html;
        $mail->AltBody = $text;
        $mail->send();
    }
}
<?php

// Composer related file.
require_once '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{
    static function send($email, $subject, $file)
    {
        $mailer = new PHPMailer(true);
        $mailer->SMTPAuth = true;
        $mailer->isSMTP();

        // Set email server.
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailer->Port = 587;

        // Set sender data.
        $mailer->Username = 'baki.bazo@gmail.com';
        $mailer->Password = 'baki2506';

        // Set email header.
        $mailer->setFrom('info@suredrive.com', 'SureDrive');
        $mailer->addAddress($email);

        // Set email data.
        $mailer->Subject = $subject;
        $mailer->Body = file_get_contents("../template/email/{$file}.html");

        $mailer->send();
    }
}

<?php

namespace App\controllers;

require __DIR__ . '/../../vendor/autoload.php';
use App\core\controller;
use App\models\User;
use App\core\database;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mailer extends controller
{
    public $mail;

    private $db;
    public $success;
    public function __construct()
    {
        $this->db = new Database();
        $this->mail = new PHPMailer(true);
    }

    public function index()
    {
        $errors = [];
        // $success = 'The new password has been sent to your email address.';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST['email'];

            $user = $this->db->query("SELECT * FROM users WHERE email = ?", [$email]);
            if ($user) {
                $randomPassword = substr(md5(uniqid()), 0, 8);

                $this->db->query("UPDATE users SET password = ? WHERE email = ?", [password_hash($randomPassword, PASSWORD_DEFAULT), $email]);

                try {

                     $this->mail = new PHPMailer();
                     $this->mail->isSMTP();
                     $this->mail->Host = 'sandbox.smtp.mailtrap.io';
                     $this->mail->SMTPAuth = true;
                     $this->mail->Port = 2525;
                     $this->mail->Username = '0044452aa79163';
                     $this->mail->Password = '268854e6ee3322';

                    $this->mail->setFrom('from@example.com', 'Mailer');
                    $this->mail->addAddress($email);
                    $this->mail->isHTML(true);
                    $this->mail->Subject = 'Password new';
                    $this->mail->Body = "<div style='background-color: greenyellow;'>New password: $randomPassword </div>";

                    $this->mail->send();
                    $this->success = 'The new password has been sent to your email address.';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
                }
            } else {
                $errors[] = "Email không tồn tại";
            }
        }
      
        $this->view('mailer', [
            'errors' => $errors,
            'success' => $this->success,
        ]);
    }
}

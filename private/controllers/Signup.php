<?php

/**
 * Signup controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\User;
use App\core\database;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';




class Signup extends controller
{	
	
    public $mail;
    private $db;

	public $success;

	function index()
	{
		$mode = isset($_GET['mode']) ? $_GET['mode'] : 'users';
		$errors = [];

		if (count($_POST) > 0) {
			$user = new User();

			if ($user->validate($_POST)) {

				$_POST['date'] = date("Y-m-d H:i:s");
				$user->insert($_POST);
				$redirect = $mode == 'students' ? 'students' : 'users';

				if ($_SERVER["REQUEST_METHOD"] === "POST") {
					$email = $_POST['email'];
		
					// $user = $this->db->query("SELECT * FROM users WHERE email = ?", [$email]);
					if ($user) {
		
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
							$this->mail->Body = "<div style='background-color: greenyellow;'>Congratulations on being a member of our educational institution</div>";
		
							$this->mail->send();
							$success = 'The new password has been sent to your email address.';
						} catch (Exception $e) {
							echo "404";
						}
					} else {
						$errors[] = "Email không tồn tại";
					}
				}

				$this->redirect($redirect);
			} else {
				//
				$errors = $user->errors;
			}

		}

		$this->view('signup', [
			'errors' => $errors,
			'mode' => $mode,
			'success' => $this->success,
		]);
	}
}

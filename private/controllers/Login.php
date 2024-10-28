<?php

/**
 * login controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\User;
use App\models\Auth;
use App\models\School;


class Login extends controller
{

	function index()
	{
		// code...
		$errors = [];

		if (count($_POST) > 0) {

			$user = new User();
			if ($row = $user->where('email', $_POST['email'])) {

				$row = $row[0];
				if (password_verify($_POST['password'], $row->password)) {

					$school = new School();
					$school_row = $school->first('school_id',$row->school_id);
					$row->school_name = $school_row->school;
					Auth::authenticate($row);
					$this->redirect('/home');
				}
			}
			if(empty($_POST['email'])){
				$errors[] = "mail Không được bỏ trống";
			}
			if(empty($_POST['password'])){
				$errors[] = "Password Không được bỏ trống";
			}else{
				$errors['password'] = "Email hoặc password không đúng";	
			}
			
		}

		$this->view('login', [
			'errors' => $errors,
		]);
	}
}

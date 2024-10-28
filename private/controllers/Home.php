<?php

/**
 * home controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\Auth;
use App\models\User;

// require_once '../models/User.php';
class Home extends controller
{

	function index()
	{

		// code...
		if(!Auth::logged_in()){
			$this->redirect('login');
		}

		$user = new User();
		$data = $user->findAll();
		

		$this->view('home', ['rows' => $data]);
	}
}

<?php

/**
 * Students controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\Auth;
use App\models\User;

// require_once '../models/User.php';
class Students extends controller
{

	function index()
	{

		// code...
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$user = new User();
		$school_id = Auth::getSchool_id();

		$data = $user->query("SELECT * FROM users u WHERE school_id = :school_id && u.rank in ('student') order by id desc", ['school_id' => $school_id]);

		//cd link module
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['students', 'students'];

		$this->view('students', [
			'rows' => $data,
			'crumbs' => $crumbs
		]);
	}
}

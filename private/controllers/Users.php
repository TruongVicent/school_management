<?php

/**
 * home controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\Auth;
use App\models\User;

// require_once '../models/User.php';
class Users extends controller
{

	function index()
	{

		// code...
		if(!Auth::logged_in()){
			$this->redirect('login');
		}

		$user = new User();
		$school_id = Auth::getSchool_id();
		//từ rank trong column của database trùng với từ khóa rank trong phpmyadmin
		$data = $user->query("SELECT * FROM users u WHERE school_id = :school_id AND u.rank != 'student' order by id desc", ['school_id' => $school_id]);
		
		//cd link crumbs
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['Staff', 'users'];

		$this->view('users', [
			'rows' => $data,
			'crumbs' => $crumbs,
		]);
	}
}

<?php

/**
 * Profile controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\User;



class Profile extends controller
{

	function index($id = '')
	{
		// code...

		$user = new User();
		$row = $user->first('user_id', $id);

		//cd link module
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['Profile', 'profile'];

		if ($row) {
			$crumbs[] = [$row->firstname, 'profile'];
		}
		$this->view('profile', [
			'row' => $row,
			'crumbs' => $crumbs
		]);
	}
}

<?php

/**
 * Classes controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\Auth;
use App\models\Classes as Clas;

// require_once '../models/school.php';
class Classes  extends controller
{

	function index()
	{
		// code...
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$classes = new Clas();

		$data = $classes->findAll();
		// $data = $classes->query("SELECT * FROM classes order by id desc");
		//cd link module
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['Classes', 'classes'];

		$this->view('classes', [

			'rows' => $data,
			'crumbs' => $crumbs

		]);
	}
	function add()
	{
		// code...
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$errors = array();

		if (count($_POST) > 0) {

			$classes = new Clas();

			if ($classes->validate($_POST)) {

				$_POST['date'] = date("Y-m-d H:i:s");

				$classes->insert($_POST);

				$this->redirect('classes');
			} else {
				//errors
				$errors = $classes->errors;
			}
		}
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['classes', 'classes'];
		$crumbs[] = ['Add', 'classes/add'];


		$this->view('classes.add', [
			'errors' => $errors,
			'crumbs' => $crumbs

		]);
	}

	function edit($id = null)
	{
		// code...
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$classes = new Clas();
		$errors = array();

		if (count($_POST) > 0) {


			if ($classes->validate($_POST)) {

				$classes->update($id, $_POST);
				$this->redirect('classes');
			} else {
				//errors
				$errors = $classes->errors;
			}
		}

		$row = $classes->where('id', $id);

		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['classes', 'classes'];
		$crumbs[] = ['Edit', 'classes/edit'];


		$this->view('classes.edit', [
			'row' => $row,
			'errors' => $errors,
			'crumbs' => $crumbs

		]);
	}
	function delete($id = null)
	{
		// code...
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$classes = new Clas();
		$errors = [];
		if (count($_POST) > 0) {
			$classes->delete($id);
			$this->redirect('classes');
		}
		$row = $classes->where('id', $id);

		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['classes', 'classes'];
		$crumbs[] = ['Delete', 'classes/delete'];

		$this->view('classes.delete', [
			'row' => $row,
			'crumbs' => $crumbs

		]);
	}
}

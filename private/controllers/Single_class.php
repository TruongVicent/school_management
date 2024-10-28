<?php

/**
 * Single_class controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\Auth;
use App\models\User;
use App\models\Classes;
use App\models\LecturesClass;
use App\models\StudentClass;


class Single_class extends controller
{

	public function index($id = '')
	{
		// code...
		$errors = [];
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		// $user = new User();
		$classes = new Classes();

		$row = $classes->first('class_id', $id);


		//cd link module
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['classes', 'classes'];
		// $row_user = [];
		if ($row) {
			$crumbs[] = [$row->class, ''];
			// $row_user = $user->first('user_id', $row->user_id);
		}
		$page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
		$lect = new LecturesClass();

		$results = false;

		if ($page_tab == 'lecturers') {
			//display contents
			$query = "SELECT * FROM class_lecturers c where class_id = :class_id && c.disabled = 0 order by id desc";
			$lecturers = $lect->query($query, ['class_id' => $id]);

			$data['lecturers'] = $lecturers;
		} else
			if ($page_tab == 'students') {
				//display contents
				$query = "SELECT * FROM class_students c where class_id = :class_id && c.disabled = 0 order by id desc";
				$students = $lect->query($query, ['class_id' => $id]);

				$data['students'] = $students;
			}

		$data['row'] = $row;
		$data['crumbs'] = $crumbs;
		$data['page_tab'] = $page_tab;
		$data['results'] = $results;
		$data['errors'] = $errors;


		$this->view('single_class', $data);
	}

	// giản viên
	public function lectureradd($id = '')
	{


		$errors = [];
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		// $user = new User();
		$classes = new Classes();

		$row = $classes->first('class_id', $id);


		//cd link module
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['classes', 'classes'];
		if ($row) {
			$crumbs[] = [$row->class, ''];
		}
		$page_tab = 'lecturers-add';
		$lect = new LecturesClass();

		$results = false;
		if (count($_POST) > 0) {

			if (isset($_POST['search'])) {
				// find lecturers
				$user = new User();
				$name = "%" . trim($_POST['name']) . "%";
				$query = "SELECT * FROM users u where (firstname like :fname || lastname like :lname) && u.rank = 'lecturers' limit 10";
				$results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
			} else
				if (isset($_POST['selected'])) {
					//add lectuer
					$query = "SELECT id from class_lecturers l where user_id = :user_id && class_id = :class_id && l.disabled = 0 limit 1";
					if ($page_tab == 'lecturers-add') {
						if (
							!$lect->query($query, [
								'user_id' => $_POST['selected'],
								'class_id' => $id,
							])
						) {
							$arr = [];
							$arr['user_id'] = $_POST['selected'];
							$arr['class_id'] = $id;
							$arr['disabled'] = 0;
							$arr['date'] = date("Y-m-d H:i:s");

							$lect->insert($arr);

							$this->redirect('single_class/' . $id . '?tab=lecturers');

						} else {
							// Giản viên đó đã thuộc lớp này
							$errors[] = "that lecturer already belongs to this class";
						}

					}
				}
		}


		$data['row'] = $row;
		$data['crumbs'] = $crumbs;
		$data['page_tab'] = $page_tab;
		$data['results'] = $results;
		$data['errors'] = $errors;


		$this->view('single_class', $data);
	}

	public function lecturerremove($id = '')
	{


		$errors = [];
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		// $user = new User();
		$classes = new Classes();

		$row = $classes->first('class_id', $id);


		//cd link module
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['classes', 'classes'];
		if ($row) {
			$crumbs[] = [$row->class, ''];
		}
		$page_tab = 'lecturers-remove';
		$lect = new LecturesClass();

		$results = false;
		if (count($_POST) > 0) {

			if (isset($_POST['search'])) {
				// find lecturers
				$user = new User();
				$name = "%" . trim($_POST['name']) . "%";
				$query = "SELECT * FROM users u where (firstname like :fname || lastname like :lname) && u.rank = 'lecturers' limit 10";
				$results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
			} else
				if (isset($_POST['selected'])) {
					//add lectuer
					$query = "SELECT id from class_lecturers l where user_id = :user_id && class_id = :class_id && l.disabled = 0 limit 1";

					if (
						$row = $lect->query($query, [
							'user_id' => $_POST['selected'],
							'class_id' => $id,
						])
					) {
						$arr = [];
						$arr['disabled'] = 1;

						$lect->update($row[0]->id, $arr);

						$this->redirect('single_class/' . $id . '?tab=lecturers');

					} else {
						// k tim thay giang vien
						$errors[] = " Not found lecturer";
					}
				}
		}


		$data['row'] = $row;
		$data['crumbs'] = $crumbs;
		$data['page_tab'] = $page_tab;
		$data['results'] = $results;
		$data['errors'] = $errors;


		$this->view('single_class', $data);
	}
	//end giản viên
	//student 
	public function studentadd($id = '')
	{


		$errors = [];
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		// $user = new User();
		$classes = new Classes();

		$row = $classes->first('class_id', $id);


		//cd link module
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['classes', 'classes'];
		if ($row) {
			$crumbs[] = [$row->class, ''];
		}
		$page_tab = 'students-add';
		$stud = new StudentClass();

		$results = false;
		if (count($_POST) > 0) {

			if (isset($_POST['search'])) {
				// find students
				$user = new User();
				$name = "%" . trim($_POST['name']) . "%";
				$query = "SELECT * FROM users u where (firstname like :fname || lastname like :lname) && u.rank = 'student' limit 10";
				$results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
			} else
				if (isset($_POST['selected'])) {
					//add students
					$query = "SELECT id from class_students l where user_id = :user_id && class_id = :class_id && l.disabled = 0 limit 1";
					if ($page_tab == 'students-add') {
						if (
							!$stud->query($query, [
								'user_id' => $_POST['selected'],
								'class_id' => $id,
							])
						) {
							$arr = [];
							$arr['user_id'] = $_POST['selected'];
							$arr['class_id'] = $id;
							$arr['disabled'] = 0;
							$arr['date'] = date("Y-m-d H:i:s");

							$stud->insert($arr);

							$this->redirect('single_class/' . $id . '?tab=students');

						} else {
							// Giản viên đó đã thuộc lớp này
							$errors[] = "that lecturer already belongs to this class";
						}

					}
				}
		}


		$data['row'] = $row;
		$data['crumbs'] = $crumbs;
		$data['page_tab'] = $page_tab;
		$data['results'] = $results;
		$data['errors'] = $errors;


		$this->view('single_class', $data);
	}

	public function studentremove($id = '')
	{


		$errors = [];
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		// $user = new User();
		$classes = new Classes();

		$row = $classes->first('class_id', $id);


		//cd link module
		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['classes', 'classes'];
		if ($row) {
			$crumbs[] = [$row->class, ''];
		}
		$page_tab = 'students-remove';
		$stud = new StudentClass();

		$results = false;
		if (count($_POST) > 0) {

			if (isset($_POST['search'])) {
				// find students
				$user = new User();
				$name = "%" . trim($_POST['name']) . "%";
				$query = "SELECT * FROM users u where (firstname like :fname || lastname like :lname) && u.rank = 'student' limit 10";
				$results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
			} else
				if (isset($_POST['selected'])) {
					//add lectuer
					$query = "SELECT id from class_students l where user_id = :user_id && class_id = :class_id && l.disabled = 0 limit 1";

					if (
						$row = $stud->query($query, [
							'user_id' => $_POST['selected'],
							'class_id' => $id,
						])
					) {
						$arr = [];
						$arr['disabled'] = 1;

						$stud->update($row[0]->id, $arr);

						$this->redirect('single_class/' . $id . '?tab=students');

					} else {
						// k tim thay giang vien
						$errors[] = " Not found student";
					}
				}
		}


		$data['row'] = $row;
		$data['crumbs'] = $crumbs;
		$data['page_tab'] = $page_tab;
		$data['results'] = $results;
		$data['errors'] = $errors;


		$this->view('single_class', $data);
	}
	//end student
}

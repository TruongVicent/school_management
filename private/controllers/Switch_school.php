<?php


/**
 * change school controller // Thay đổi trường học
 */
namespace App\controllers;

use App\core\controller;
use App\models\User;
use App\models\Auth;

class Switch_school extends controller
{

    function index($id = '')
    {
        Auth::switch_school($id);
        $this->redirect('schools');

    }
}

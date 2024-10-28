<?php


/**
 * Logout controller
 */
namespace App\controllers;

use App\core\controller;
use App\models\User;
use App\models\Auth;

class Logout extends controller
{

    function index()
    {

        Auth::logout();
        $this->redirect('login');

    }
}

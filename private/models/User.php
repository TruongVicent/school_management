<?php

namespace App\models;

use App\core\model;


class User extends model
{
    protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'rank',
        'date',
    ];

    protected $beforeInsert = [
        'make_user_id',
        'make_school_id',
        'hash_password'
    ];

    // protected $afterSelect = [
    //     'get_school_name',
    // ];

    protected $table = 'users';

    public function validate($DATA)
    {

        $this->errors = [];


        //check for firstname
        if (empty($DATA['firstname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['firstname'])) {
            $this->errors['firstname'] = "Firstname Chỉ được nhập chữ cái";
        }
        //check for lastname
        if (empty($DATA['lastname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['lastname'])) {
            $this->errors['lastname'] = "Lastname Chỉ được nhập chữ cái";
        }
        // check for email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Trường này phải là email";
        }
        // check if email exitsts
        if ($this->where('email', $DATA['email'])) {
            $this->errors['email'] = "Email này đã được tạo";
        }
        // check for password
        if (empty($DATA['password']) || $DATA['password'] !== $DATA['password2']) {
            $this->errors['password'] = "Mật khẩu không trùng khớp";
        }
        if (strlen($DATA['password']) <= 6 || strlen($DATA['password']) > 16) {
            $this->errors['password'] = "Mật khẩu phải dài từ 8 đến 16 ký tự";
        }
        // check for Gender
        $genders = ['female', 'male'];
        if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
            $this->errors['gender'] = "Bạn chưa chọn gender";
        }
        // check for Rank
        $ranks = ['student', 'lecturers', 'admin', 'super_admin'];
        if (empty($DATA['rank']) || !in_array($DATA['rank'], $ranks)) {
            $this->errors['rank'] = "Bạn chưa chọn rank";
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function make_user_id($data)
    {
        // $data['user_id'] = random_string(6);
        $data['user_id'] = strtolower($data['firstname'] . "." . $data['lastname']);

        while ($this->where('user_id', $data['user_id'])) {
            $data['user_id'] .= rand(10, 9999);
        }
        return $data;
    }

    // public function get_school_name($data)
    // {
    //    foreach ($data as $key => $value) {
    //     # code...
       
    //     if (isset($data[$key]->school_id)) {
    //         $school_row = $this->first('school_id', $data[$key]->school_id);
            
    //         if(is_object($school_row)){
    //             $data[$key]->school_name = $school_row->school;
    //         }
        
    //     }
    //     }
    //     return $data;
    // }

    public function make_school_id($data)
    {
        if (isset($_SESSION['USER']->school_id)) {
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }
    public function hash_password($data)
    {

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

}
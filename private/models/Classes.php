<?php

namespace App\models;

use App\core\model;
use App\models\User;


/**
 * Classes Model
 */
class Classes extends Model
{
    
	protected $allowedColumns = [
        'class',
        'date',
    ];

    protected $beforeInsert = [
        'make_school_id',
        'make_class_id',
        'make_user_id',
    ];

    protected $afterSelect = [
        'get_user',
    ];

    protected $table = 'classes';

    public function validate($DATA)
    {
        $this->errors = array();

        //check for class name
        if(empty($DATA['class']) || !preg_match('/^[a-zA-Z]+\d+$/', $DATA['class']))
        {
            $this->errors['class'] = "Only letters allowed in class name";
        }
 
        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }

    
    public function make_school_id($data)
    {    
     
        if(isset($_SESSION['USER']->school_id)){
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        
        return $data;
    }
    public function make_user_id($data)
    {    
     
        if(isset($_SESSION['USER']->user_id)){
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        
        return $data;
    }

    public function make_class_id($data)
    {
        
        $data['class_id'] = random_string(6);
        return $data;
    }

    // public function get_user($data)
    // {
        
    //     $user = new User();
    //     foreach ($data as $key => $row) {
    //         // code...
    //         $result = $user->where('user_id',$row->user_id);
    //         $data[$key]->user = is_array($result) ? $result[0] : false;
    //     }
       
    //     return $data;
    // }

    public function get_user($data)
    {
        
        $user = new User();
        foreach ($data as $key => $row) {
            // code...
            $result = $user->where('user_id',$row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
        }
       
        return $data;
    }

 
}
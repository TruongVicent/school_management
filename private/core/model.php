<?php

/**
 * main model
 */
namespace App\core;

use App\core\database;
use App\models\User;

class model extends database
{

    // protected $table = "users";
    public $errors = [];
    public function __construct()
    {
        //code...
        if (!property_exists($this, 'table')) {
            $this->table = strtolower(model::class) . "s";
        }
    }

    public function where($column, $value,$order = 'desc')
    {

        $column = addslashes($column);
        $query = "SELECT * from $this->table where $column = :value order by id $order";
        $data = $this->query($query, [
            'value' => $value
        ]);

        //run function after select
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }

        return $data;
    }


    //// where one
    // lay muc dau tien
    public function first($column, $value,$order = 'desc')
    {

        $column = addslashes($column);
        $query = "SELECT * from $this->table where $column = :value order by id $order";
        $data = $this->query($query, [
            'value' => $value
        ]);

        //run function after select
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }

        if(is_array($data)){
            $data = $data[0];
        }

        return $data;
    }

    public function findAll()
    {
        $query = "SELECT * from $this->table ";
        $data = $this->query($query);

        //run function after select
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }
        return $data;
    }
    public function insert($data)
    {
        //remove unwanted columns
        //Xóa các cột không mong muốn
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }

        }

        //run functions before insert
        //Chạy hàm trước khi chèn 
        if (property_exists($this, 'beforeInsert')) {
            foreach ($this->beforeInsert as $func) {
                $data = $this->$func($data);
            }
        }

        $keys = array_keys($data);

        $columns = implode(',', array_map(function ($key) {
            return "`$key`"; // Sử dụng dấu ngoặc `` cho mỗi tên cột để không bị trùng với key là rank trong mysql và dữ liệu
        }, $keys));
        $values = implode(',:', $keys);

        $query = "INSERT INTO $this->table ($columns) VALUES (:$values)";


        return $this->query($query, $data);

    }
    public function update($id, $data,$order = 'desc')
    {
        $str = "";
        foreach ($data as $key => $value) {
            # code...
            $str .= $key . "=:" . $key . ",";

        }
        $str = trim($str, ",");
        $data['id'] = $id;
        $query = "UPDATE $this->table set $str where id = :id order by id $order";
        // echo $query;        
        return $this->query($query, $data);
    }
    public function delete($id)
    {
        $query = "DELETE from $this->table where id = :id";
        $data['id'] = $id;
        return $this->query($query, $data);
    }

}
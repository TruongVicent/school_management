<?php

/**
 * Database connection
 */
namespace App\core;

use PDO;

class database
{

    private function connect()
    {
        $string = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME;   // bindparam để tránh bị hack bằng câu truy vấn sql (:column +$, :value + $)
        if (!$con = new PDO($string, DBUSER, DBPASS)) {
            die ("Ket noi khong thanh cong");
        }
        return $con;

    }

   
	public function query($query, $data = [], $data_type = "object")
	{
		$con = $this->connect();
		$stm = $con->prepare($query);
	
        $result = [];
        //$result = false;
		if ($stm) {
			$check = $stm->execute($data);
	
			if ($check) {
				if ($data_type == "object") {
					$result = $stm->fetchAll(PDO::FETCH_OBJ);
				} else {
					$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				}
				// if (is_array($data) && count($data) > 0) {
				// 	return $data;
				// // } else {
				// 	// echo "Không có dữ liệu trả về từ truy vấn.";
                //     echo "";
				// }
			} else {
				$errorInfo = $stm->errorInfo();
				echo "Lỗi SQL: " . $errorInfo[2];
			}
		} else {
			echo "Lỗi trong quá trình chuẩn bị truy vấn.";
		}

         //run function after select
         if (is_array($result)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $result = $this->$func($result);
                }
            }
        }
        if (is_array($result) && count($result) > 0) {
            return $result;
        }

		return false;
	}
    
}
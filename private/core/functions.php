<?php

function get_var($key, $default = "")
{

    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}

function get_select($key, $value)
{

    if (isset($_POST[$key])) {
        if ($_POST[$key] == $value) {
            return "selected";
        }
    }
}
function esc($var)
{
    //găn chặn các cuộc tấn công XSS (Cross-Site Scripting). XSS là một loại tấn công phổ biến trong đó kẻ tấn công chèn mã JavaScript hoặc HTML độc hại vào trang web hoặc ứng dụng web, và khi người dùng truy cập trang web đó, mã độc hại sẽ được thực thi trên trình duyệt của họ.
    //Hàm htmlspecialchars() là một phương pháp cơ bản để tránh XSS
    //bạn đảm bảo rằng bất kỳ dữ liệu người dùng nào cũng sẽ được xử lý và hiển thị một cách an toàn trong trang web
    return htmlspecialchars($var);
}
function random_string($length)
{
    $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $text = "";

    for ($x = 0; $x < $length; $x++) {

        $random = rand(0, 61);
        $text .= $array[$random];
    }

    return $text;
}
function get_date($date)
{
    return date("jS M, Y", strtotime($date));
}

function show($data)
{
    echo "<pre>";
    print_r($data);
}

function get_image($image, $gender = 'male')
{
    if (!file_exists($image)) {
        $image = '/' . ASSETS . '/user_female.jpg';
        if ($gender == 'male') {
            $image = '/' . ASSETS . '/user_male.jpg';
        }
    }
    return $image;
}
// random code email
function generateRandomString($length = 5)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function views_path($view)
{
    if (file_exists("../private/views/" . $view . ".inc.php")) {
        return ("../private/views/" . $view . ".inc.php");
    } else {
        return ("../private/views/404.view.php");
    }
}

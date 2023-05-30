<?php
include('db_helper.php');
// include('conn.php');
header("Content-Type:application/json");

$db_helper = new DbHelper();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $mobile_num = $_POST['mobile_num'];

    $resuilt = $db_helper->insertNewStudent($id, $name, $age, $email, $mobile_num);


}


?>

<?php
include('db_helper.php');
header("Content-Type:application/json");

$db_helper = new DbHelper();


if ($_SERVER["REQUEST_METHOD"] == "put") {
    if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["age"]) && isset($_POST["email"]) && isset($_POST["mobile_num"])) {

        $id = $_POST["id"];
        $name = $_POST["name"];
        $age = $_POST["age"];
        $email = $_POST["email"];
        $mobile_num = $_POST["mobile_num"];

        $db_helper->updateStudent($id, $name, $age, $email, $mobile_num);
        echo "Student is update";
    } else {
        $db_helper->createResponse(false, 0, array("error" => "Missing data"));
        http_response_code(400);
        echo "Student isnot update";

    }
}

?>

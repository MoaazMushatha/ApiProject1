<?php
include('db_helper.php');


//get student 
header("Content-Type:application/json");

try {

    $db_helper = new DbHelper();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $db_helper->getAllStudents();
    } else {
        throw Exception("No Data Found");
    }

} catch (Exception $exception) {
    $db_helper->createResponse(false, 0, array("error" => $exception->getMessage()));
}
 
?>

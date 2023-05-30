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
// $conn = mysqli_connect("localhost", "root", "", "stdmang");

// $query = "SELECT * FROM students";

// $result = mysqli_query($conn, $query);

// $students = [];
// $count = mysqli_num_rows($result);
// if ($count > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         array_push($students, $row);
//     }
//     $db_helper = new DbHelper();

//     $db_helper->createResponse(true, $count, $students);


// include 'db_helper.php';
// header("Content-Type:application/json");



// echo json_encode($students);
?>
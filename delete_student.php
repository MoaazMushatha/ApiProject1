<?php
include('db_helper.php');
// include('conn.php');
header("Content-Type:application/json");

$db_helper = new DbHelper();
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $db_helper->deleteStudent($id);

} else {
    echo json_encode("error in Delete");
}

?>
<?php
// include('conn.php');

class DbHelper
{
    private $connection;

    public function __construct()
    {
        $host = "localhost";
        $username = "root";
        $password = "yourpassword";
        $dbname = "stdmang";

        $this->connection = new mysqli($host, $username, "", $dbname);

        if ($this->connection->connect_error) {
            die("فشل الاتصال: " . $this->connection->connect_error);
        } else {
            // echo "Successfuly";
        }

    }


    function createResponse($isSuccess, $count, $data)
    {
        echo json_encode(
            array
            (
                "success" => $isSuccess,
                "count" => $count,
                "data" => $data
            )
        );

    }
    function createStudentResponse($id, $name, $age, $email, $mobile_num)
    {
        return array(
            "id" => $id,
            "name" => $name,
            "age" => $age,
            "email" => $email,
            "mobile_num" => $mobile_num
        );
    }

    // function updataStudentResponse($id, $name, $age)
    // {
    //     return array(
    //         "id" => $id,
    //         "name" => $name,
    //         "age" => $age,
    //     );
    // }

    function getAllStudents()
    {
        try {
            $sql = "select * from students";
            $result = $this->connection->query($sql);

            $count = $result->num_rows;
            if ($count > 0) {
                $all_students_array = array();
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $name = $row["name"];
                    $age = $row["age"];
                    $email = $row["email"];
                    $mobile_num = $row["mobile_num"];
                    // create associative array for the student
                    $student_array = $this->createStudentResponse($id, $name, $age, $email, $mobile_num);

                    array_push($all_students_array, $student_array);
                }
                $this->createResponse(true, $count, $all_students_array);
            } else {
                throw Exception("No Data Found");
            }
        } catch (Exception $exception) {
            $this->createResponse(false, 0, array("error" => $exception->getMessage()));
        }
    }

    public function insertNewStudent($id, $name, $age, $email, $mobile_num)
    {
        try {
            $sql = "INSERT INTO students (id,name,age,email,mobile_num)VALUES ($id,'$name',$age,'$email','$mobile_num')";
            $result = $this->connection->query($sql);
            if ($result == true) {

                $this->createResponse(
                    true,
                    $this->createStudentResponse($id, $name, $age, $email, $mobile_num),
                    "Successfuly"
                );

            } else {
                $this->createResponse(false, 0, "inserted error");

            }
        } catch (Exception $error) {
            $this->createResponse(false, $error->getMessage(), "error in insert");
        }
    }


    public function updateStudent($id, $name, $age, $email, $mobile_num)
    {
        try {
            $sql = "UPDATE students SET name=$name, age=$age, email=$email, mobile_num=$mobile_num WHERE id=$id";
            $result = $this->connection->query($sql);
            if ($result == true) {

                $this->createResponse(
                    true,
                    $this->createStudentResponse($id, $name, $age, $email, $mobile_num),
                    "Success update"
                );

            } else {
                $this->createResponse(false, 0, "updatae error");

            }
        } catch (Exception $error) {
            $this->createResponse(false, $error->getMessage(), "error in update");
        }
    }


    function deleteStudent($id)
    {
        try {
            $sql = "DELETE FROM students WHERE id = ?";
            $result = $this->connection->query($sql);
            $del = mysqli_affected_rows($this->connection);
            if ($del > 0) {
                $this->createResponse(true, 1, array("data" => "student has been deleted"));
            } else {
                throw new Exception("There are no students with the passed id");
            }
        } catch (Exception $exception) {
            $this->createResponse(false, 0, array("error" => $exception->getMessage()));
        }
    }
}

?>
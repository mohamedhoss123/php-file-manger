<?php
$fileName = $_FILES['file']['name'];
$myrand = rand();
$location = "./files/".strval($myrand).$fileName;
if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    $conn = mysqli_connect("localhost", "root", "", "file_manger");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $randId = strval(rand());
        $sql = "INSERT INTO file (id,name,path,folder_id)
        VALUES (".$myrand.",'".$fileName."','".$location."',".$_POST['parent'].")";
        if ($conn->query($sql) == TRUE) {
            echo "done;";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
else{
    echo "error";
}
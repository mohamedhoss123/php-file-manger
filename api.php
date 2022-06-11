<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    if (isset($_POST["type"])) {
        $conn = mysqli_connect("localhost", "root", "", "file_manger");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO folder ( name, parent_id)
        VALUES ('".$_POST['folder-name']."', ".$_POST['folder-id'].")";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

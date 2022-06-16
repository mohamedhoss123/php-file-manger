<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] == "folder" && $_POST['action'] == "create") {
        $conn = mysqli_connect("localhost", "root", "", "file_manger");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $randId = strval(rand());
        $sql = "INSERT INTO folder ( id,name, parent_id)
        VALUES (" . $randId . ",'" . $_POST['folder-name'] . "'," . $_POST['folder-id'] . ")";
        if ($conn->query($sql) === TRUE) {
            $arr = array("type" => "folder", "status" => "create", "id" => $randId, "name" => $_POST["folder-name"]);
            echo json_encode($arr);
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    if ($_POST['type'] == "folder" && $_POST['action'] == "delet") {
        $conn = mysqli_connect("localhost", "root", "", "file_manger");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM `folder` WHERE `folder`.`id` = " . $_POST['folder-id'] . ";";
        if ($conn->query($sql) === TRUE) {
            // if folder deleted succefuly from the database this code will exucte 
            // this code will see if file not found file will remove from the files folder  
            // from the local directory
            $conn2 = mysqli_connect("localhost", "root", "", "file_manger");
            $slctFromDbPath = mysqli_query($conn2, "SELECT path FROM file");
            $file2 = mysqli_fetch_all($slctFromDbPath, MYSQLI_ASSOC);
            $file4 = array();
            foreach($file2 as $row){
                array_push($file4,$row['path']);
            }
            $file3 = array();
            $localfiles = scandir("./files");
            $mylocal = array_diff($localfiles,array(".",".."));
            foreach($mylocal as $row){
                array_push($file3,"./files/".$row);
            }
            @$localfileresult = array_diff($file3,$file4);
            foreach($localfileresult as $file){
                unlink($file);
            }
            $arr = array("type" => "folder", "action" => "delet", "id" => $_POST['folder-id'],"files"=>$localfileresult);
            echo json_encode($arr);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    if ($_POST['type'] == "file" && $_POST['action'] == "delet") {
        $conn = mysqli_connect("localhost", "root", "", "file_manger");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM `file` WHERE `file`.`id` = " . $_POST['file-id'] . ";";
        if ($conn->query($sql) === TRUE) {
            $arr = array("type" => "file", "action" => "delet", "id" => $_POST['file-id'], "status");
            if (!unlink($_POST['path'])) {
                $arr['status'] = "err";
            } else {
                $arr['status'] = "done";
            }
            echo json_encode($arr);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

<?php
require_once "./header.php";    
    echo '<div class="main-contaner" id="main-contaner">';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $conn = mysqli_connect("localhost", "root", "", "file_manger");
    $result = mysqli_query($conn, "SELECT * FROM folder where parent_id =". $_GET["id"]);
    $file = mysqli_fetch_all($result, MYSQLI_ASSOC);


    echo"<div id='folder-contaner'>";
    foreach($file as $row){
        echo "<div class='contaner' id='folder".$row["id"]."'>";
        echo "<img class='img' src='./media/folder-solid.svg'>";
        echo "<a href='./folder.php?id=".$row["id"]."' data-id='".$row["id"]."'id='folder'>".$row["name"]."</a>";
        echo "<button id='folder-del-btn' class='del-btn' data-id='".$row["id"]."'>delet</button>";
        echo "</div>";
    }

    echo"</div>";

    mysqli_free_result($result);
    mysqli_close($conn);




    $conn = mysqli_connect("localhost", "root", "", "file_manger");
    $result = mysqli_query($conn, "SELECT * FROM file where folder_id =".$_GET["id"]);
    $file = mysqli_fetch_all($result, MYSQLI_ASSOC);


    echo"<div id='file-contaner'>";
    foreach($file as $row){
        echo "<div class='contaner'>";
        echo "<img class='img' src='./media/file-solid.svg'>";
        echo "<a href='".$row['path']."' id=".$row['id'].">".$row['name']."</a>";
        echo "<button id='file-del-btn' class='del-btn' data-id='".$row["id"]."'>delet</button>";
        echo "</div>";
        echo "<br>";  
    }
    echo"</div>";

    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

</div>
<script src="./api.js"></script>
</body>
</html>
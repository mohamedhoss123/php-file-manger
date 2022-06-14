<?php include_once "./header.php"?>



<div class="main-contaner" id="main-contaner">

    <!-- print folder from the db  -->
    <?php
    $conn = mysqli_connect("localhost", "root", "", "file_manger");
    $result = mysqli_query($conn, "SELECT * FROM folder where parent_id is null");
    $file = mysqli_fetch_all($result, MYSQLI_ASSOC);


    echo"<div id='folder-contaner'>";
    // printing the data come from database in html
    foreach($file as $row){
        echo "<div class='contaner'>";
        echo "<img class='img' src='./media/folder-solid.svg'>";
        echo "<a href='./folder.php?id=".$row["id"]."' data-id='".$row["id"]."'id='folder'>".$row["name"]."</a>";
        echo "<button id='folder-del-btn' class='del-btn' data-id='".$row["id"]."'>delet</button>";
        echo "</div>";
        echo "<br>"; 
    }
    echo"</div>";

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>  

    <!-- print files from the server -->
    <?php
    $conn = mysqli_connect("localhost", "root", "", "file_manger");
    $result = mysqli_query($conn, "SELECT * FROM file where folder_id is null");
    $file = mysqli_fetch_all($result, MYSQLI_ASSOC);


    echo"<div id='file-contaner'>";
    foreach($file as $row){
        echo "<div class='contaner'>";
        echo "<img class='img' src='./media/file-solid.svg'>";
        echo"<a href='".$row['path']."' id=".$row['id'].">".$row['name']."</a>";
        echo "<button id='file-del-btn' class='del-btn' data-id='".$row["id"]."'>delet</button>";
        echo "</div>";
        echo "<br>";  
    }
    echo"</div>";

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</div>
<script src="./api.js"></script>
</body>
</html>
<?php include_once "./header.php" ?>
<div class="file-contaner" id="file-contaner">
    <!-- print folder from the db  -->
    <?php
    $conn = mysqli_connect("localhost", "root", "", "file_manger");
    $result = mysqli_query($conn, "SELECT * FROM folder where parent_id is null");
    $file = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach($file as $row){
        echo "<div class='contaner'>";
        echo "<img class='img' src='./media/folder-solid.svg'>";
        echo "<a href='./folder.php?id=".$row["id"]."' data-id='".$row["id"]."'id='folder'>".$row["name"]."</a>";
        echo "</div>";
        echo "<br>"; 
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>

    <!-- print files from the server -->
    <?php
    $conn = mysqli_connect("localhost", "root", "", "file_manger");
    $result = mysqli_query($conn, "SELECT * FROM file where folder_id is null");
    $file = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach($file as $row){
        echo "<div class='contaner'>";
        echo "<img class='img' src='./media/file-solid.svg'>";
        echo $row["name"];
        echo "</div>";
        echo "<br>";  
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</div>
<script src="./api.js"></script>
</body>
</html>
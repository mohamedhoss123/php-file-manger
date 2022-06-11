<?php
require_once "./header.php";    
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $conn = mysqli_connect("localhost", "root", "", "file_manger");
    $result = mysqli_query($conn, "SELECT * FROM folder where parent_id =". $_GET["id"]);
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
}
?>
</div>
<script src="./api.js"></script>
</body>
</html>
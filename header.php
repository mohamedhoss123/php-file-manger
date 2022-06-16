<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>File manger</title>
</head>

<body>
    <div class="add-new">
        <div class="new-folder">
            <input type="text" id="inp" name="folderName">
            <button id="new-folder" type="submit">add new folder</button>
            
        </div>
        <div >
            <p>add new file</p>
            <input type="file" name ="file"id="file">
            <button id="add-file-button" type="submit">add</button>
            <p id="progress"></p>
        </div>
    </div>
    <hr>
<?php
$myId = @$_GET["id"];

?>
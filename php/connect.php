<?php
$conn = new mysqli('localhost','root','','nobocotobeats');
    if(!$conn){
        echo "error";
        $conn->close();
     }
?>
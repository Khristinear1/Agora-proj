<?php
if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ass3agora_db";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM clients where id=$id";
    $connection->query($sql);

}

    header("location: /agora/businessac_page.php");
    exit;
?>
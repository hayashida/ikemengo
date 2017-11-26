<?php
    $id = $_GET['id'];

    //DB
    require 'lib/db.php';

    $db = new db();
    $db->connect();

    $sql = "SELECT photo FROM mens where id = '${id}'";
    $rows = $db->query($sql);

    header("Content-Type: image/png");
    foreach ($rows as $row) {
        echo $row['photo'];
    }

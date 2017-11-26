<?php
    $shopid = $_GET['shopid'];

    //DB
    require 'lib/db.php';

    $db = new db();
    $db->connect();

    $date_at = date('Y-m-d');

    $eof = true;
    $sql = "SELECT * FROM goods where gnavi_id = '${shopid}' AND date_at = '${date_at}'";
    $rows = $db->query($sql);
    foreach ($rows as $row) {
        $eof = false;
        break;
    }

    if($eof){
        $sql = "insert into goods(gnavi_id,good,date_at) value(?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$shopid,1, $date_at]);
    }else{
        $sql = "update goods set good = good+1 where gnavi_id = ? AND date_at = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$shopid, $date_at]);
    }

    header('Location: shopinfo.php?shopid='.$shopid);
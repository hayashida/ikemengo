<?php
$shopid = $_GET['shopid'];

//DB
require 'lib/db.php';

$db = new db();
$db->connect();

$sql = 'SELECT * FROM good where gnavi_id = ?';
$stmt = $db->prepare($sql);
$rows = $stmt->execute([$shopid]);

if(is_null($rows)){
    $sql = "insert into goods(gnavi_id,good) value(?,?)";
$stmt = $db->prepare($sql);
$stmt->execute([$shopid],0);
}else{
$sql = "update goods set good = good+1 where gnavi_id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$shopid]);
    }
?>
 <html>

                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
                    <title>イケメンGO</title>
                    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                    <script src="js/jquery.js"></script>

                    <!-- materializeへのリンク -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">

                    <!-- 最終調整cssへのリンク -->
                    <link href="css/style.css" type="text/css" rel="stylesheet" />

                </head>

                <body>
                <a href="top.html">トップへ</a>
                </body>

                </html>
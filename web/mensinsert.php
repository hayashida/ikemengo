<?php

require 'lib/db.php';

$db = new db();
$db->connect();
if (!empty($_POST))
{   
    $comment = $_POST['comment'];
    $shopid = $_POST['shopid'];
    $imgdat = null;
    if($_FILES['image']['size'] == 0 && $_FILES['image']['error'] == 0){
    // バイナリデータ
    $fp = fopen($_FILES["image"]["tmp_name"], "rb");
    $imgdat = fread($fp, filesize($_FILES["image"]["tmp_name"]));
    fclose($fp);
    $imgdat = addslashes($imgdat);
     
    // 拡張子
    $dat = pathinfo($_FILES["image"]["name"]);
    $extension = $dat['extension'];
     
    // MIMEタイプ
    if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
    else if( $extension == "gif" ) $mime = "image/gif";
    else if ( $extension == "png" ) $mime = "image/png";
    }
    // MySQL登録
    $sql = "INSERT INTO mens(gnavi_id, photo, comment) VALUES(?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$shopid,$imgdat,$comment]);
} ?>
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
        <h1>投稿完了</h1>
        <a href="top.html">トップへ</a>
    </body>
</html>
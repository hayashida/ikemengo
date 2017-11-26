<?php
    require 'lib/db.php';

    $db = new db();
    $db->connect();

    if (!empty($_POST)) {
        $comment = $_POST['comment'];
        $shopid = $_POST['shopid'];
        $imgdat = null;
        if($_FILES['image']['size'] == 0 || $_FILES['image']['error'] == 0){
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
    }
?>
<?php include 'layout/header.php' ?>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo"><店舗名を表示></a>
        </div>
    </nav>
</div>
<div class="container">
    <div class="section">
        <h5>投稿しました！</h5>
        <p>
            イケメンありがとうございます！！<br>
            <a href="index.php">トップページに戻る</a>
        </p>
    </div>
</div>
<?php include 'layout/footer.php' ?>

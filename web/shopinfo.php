<?php
    $shopid = $_GET['shopid'];

    //DB
    require 'lib/db.php';

    $db = new db();
    $db->connect();
    /*****************************************************************************************
    　ぐるなびWebサービスのレストラン検索APIで緯度経度検索を実行しパースするプログラム
    　注意：緯度、経度、範囲の値は固定で入れています。
    　　　　アクセスキーはユーザ登録時に発行されたキーを指定してください。
    *****************************************************************************************/

    //エンドポイントのURIとフォーマットパラメータを変数に入れる
    $uri   = "https://api.gnavi.co.jp/RestSearchAPI/20150630/";
    //APIアクセスキーを変数に入れる
    $acckey= "aad069ce460b9d927353192ce6f143ea";
    //返却値のフォーマットを変数に入れる
    $format= "json";
    //URL組み立て
    $url  = sprintf("%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey,"&id=", $shopid);

    //API実行
    $json = file_get_contents($url);
    //取得した結果をオブジェクト化
    $obj  = json_decode($json);

    $shop_name = '';
    foreach((array)$obj as $key => $restArray){
        if (strcmp($key, "rest") == 0) {
            $shop_name = $restArray->{'name'};
        }
    }

    //店舗IDを元にいいねがあるかの検索
    $goods = 0;
    $sql = "SELECT * FROM goods where gnavi_id = '${shopid}'";
    $rows = $db->query($sql);
    foreach ($rows as $row) {
        $goods += $row['good'];
    }
    //文字列であるかをチェック
    function checkString($input)
    {
        if(isset($input) && is_string($input)) {
            return true;
        }else{
            return false;
        }
    }
?>
<?php include 'layout/header.php' ?>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo"><?php echo $shop_name ?></a>
        </div>
    </nav>
</div>
<div class="container">
    <div class="section">
        <div class="chip"><a href="good.php?shopid=<?php echo $shopid ?>">いいね！</a><?php echo $goods ?></div>
        <?php if (checkString($restArray->{'image_url'}->{'shop_image1'})) { ?>
        <div class="row">
            <div class="col s12">
                <img style="width:50%" src="<?php echo $restArray->{'image_url'}->{'shop_image1'} ?>">
            </div>
        </div>
        <?php } ?>
        <?php if (checkString($restArray->{'address'})) { ?>
        <div class="row">
            <div class="col s2">住所:</div>
            <div class="col s10"><?php echo $restArray->{'address'}; ?></div>
        </div>
        <?php } ?>
        <?php if(checkString($restArray->{'tel'})) { ?>
        <div class="row">
            <div class="col s2">TEL:</div>
            <div class="col s10"><?php echo $restArray->{'tel'} ?></div>
        </div>
        <?php } ?>
        <?php if (checkString($restArray->{'opentime'})) { ?>
        <div class="row">
            <div class="col s2">営業時間</div>
            <div class="col s10"><?php echo $restArray->{'opentime'} ?></div>
        </div>
        <?php } ?>
    </div>
    <div class="section">
        <h5>イケメン情報</h5>
        <?php
            $sql = "SELECT * FROM mens where gnavi_id = '${shopid}'";
            $rows = $db->query($sql);

            foreach ($rows as $row) {
        ?>
        <div class="row">
            <div class="col s4"><img src="photo.php?id=<?php echo $row['id'] ?>" alt=""></div>
            <div class="col s8"><?php echo $row['comment'] ?></div>
        </div>
        <?php
            }
        ?>
    </div>
</div>
<?php include 'layout/footer.php' ?>

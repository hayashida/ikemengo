<?php
    $title = '登録';

    //エンドポイントのURIとフォーマットパラメータを変数に入れる
    $uri   = "https://api.gnavi.co.jp/RestSearchAPI/20150630/";
    //APIアクセスキーを変数に入れる
    $acckey= "aad069ce460b9d927353192ce6f143ea";
    //返却値のフォーマットを変数に入れる
    $format= "json";
    //URL組み立て
    $url  = sprintf("%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey,"&id=", $_GET['shopid']);

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
        <h5>イケメンGET</h5>
        <form enctype="multipart/form-data" action="mensinsert.php" method="POST">
            <div class="input-field">
                <input type="text" name="comment" placeholder="コメントを入力">
            </div>
            <div class="input-field">
                <input name="image" type="file" />
            </div>
            <div class="input-field">
                <button class="btn waves-effect waves-light" type="submit" name="save">
                    GET
                    <i class="material-icons right">send</i>
                </button>
            </div>
            <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
            <input type="hidden" name ="shopid" value = "<?php echo $_GET['shopid']; ?>">
        </form>
    </div>
</div>
<?php include 'layout/footer.php' ?>

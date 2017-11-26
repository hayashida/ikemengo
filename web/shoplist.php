<?php
    $title = '見つけた';
    $url = "shoplist.php";

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
    //緯度・経度、範囲を変数に入れる
    //緯度経度は日本測地系で日比谷シャンテのもの。範囲はrange=1で300m以内を指定している。
    $lat   = $_GET['lati'];
    $lon   = $_GET['long'];
    $range = 1;

    //URL組み立て
    $url  = sprintf("%s%s%s%s%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey, "&latitude=", $lat,"&longitude=",$lon,"&range=",$range);
    //API実行
    $json = file_get_contents($url);
    //取得した結果をオブジェクト化
    $obj  = json_decode($json);

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
            <a href="#" class="brand-logo">お店を選ぶ</a>
        </div>
    </nav>
</div>
<div class="container">
    <div class="section shoplist">
    <?php
        //結果をパース
        //トータルヒット件数、店舗番号、店舗名、最寄の路線、最寄の駅、最寄駅から店までの時間、店舗の小業態を出力
        foreach ((array)$obj as $key => $val) {
            if (strcmp($key, "rest") == 0) {
                foreach ((array)$val as $restArray) {
                    if (checkString($restArray->{'id'})) {
                        $shop_id = $restArray->{'id'};
                        $shop_name = $restArray->{'name'};
    ?>
        <div class="row">
            <div class="col s4 shopimage">
                <?php if (checkString($restArray->{'image_url'}->{'shop_image1'})) { ?>
                <img src="<?php echo $restArray->{'image_url'}->{'shop_image1'} ?>">
                <?php } ?>
            </div>
            <div class="col s8 shopname">
                <a href ="comment.php?shopid=<?php echo $shop_id ?>"><?php echo $shop_name ?></a>
            </div>
        </div>
    <?php
                    }
                }
            }
        }
    ?>
    </div>
</div>
<?php include 'layout/footer.php' ?>
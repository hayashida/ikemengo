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
  ?>
    <h2>お店選択</h2>
    <?php
//結果をパース
//トータルヒット件数、店舗番号、店舗名、最寄の路線、最寄の駅、最寄駅から店までの時間、店舗の小業態を出力
foreach((array)$obj as $key => $restArray){
 
   if(strcmp($key, "rest") == 0){
           //いいね変数
           $goods =0;
           //店舗IDを元にいいねがあるかの検索
           $sql = 'SELECT * FROM goods where gnavi_id = ?';
            $stmt = $db->prepare($sql);
            $rows = $stmt->execute([$restArray->{'id'}]);
           foreach ((array)$rows as $row) {
            $goods += $row['good'];
            }
            if(checkString($restArray->{'name'})) echo $restArray->{'name'};
           ?><br>
        <?php
           if(checkString($restArray->{'image_url'}->{'shop_image1'})){
            ?><img style="width:50%" src="<?php echo $restArray->{'image_url'}->{'shop_image1'} ?>"><br>
            <?php
            ?>住所：
                <?php if(checkString($restArray->{'address'})) echo $restArray->{'address'};
            ?>TEL：
                <?php if(checkString($restArray->{'tel'})) echo $restArray->{'tel'};
            ?>営業時間：
                <?php if(checkString($restArray->{'opentime'})) echo $restArray->{'opentime'};
           ?> いいね数:
                <?php echo $goods;
           }
       
 
   }
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
            $sql = 'SELECT * FROM mens where gnavi_id = ?';
            $stmt = $db->prepare($sql);
            $rows = $stmt->execute([$shopid]);
            foreach ((array)$rows as $row) {
            echo $row['image'];
            echo $row['comment'];
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
                
                <a href="good.php?shopid =<?php echo $shopid ?>">いいね</a>
                <a href="top.html">トップへ</a>
                </body>

                </html>
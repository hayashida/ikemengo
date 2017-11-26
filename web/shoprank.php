<?php
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

if(isset($_POST['name'])){
    //店舗名を入れる
    $name = $_POST['shopname'];;
//URL組み立て
$url  = sprintf("%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey, "&name=",$name);
    
}else{
    //緯度・経度、範囲を変数に入れる
    $lat   = $_GET['lati'];
    $lon   = $_GET['long'];
    $range = 1;
    //URL組み立て
$url  = sprintf("%s%s%s%s%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey, "&latitude=", $lat,"&longitude=",$lon,"&range=",$range);
}

//API実行
$json = file_get_contents($url);
//取得した結果をオブジェクト化
$obj  = json_decode($json);
  ?>
    <h2>お店選択</h2>
    <?php
//結果をパース
//トータルヒット件数、店舗番号、店舗名、最寄の路線、最寄の駅、最寄駅から店までの時間、店舗の小業態を出力
foreach((array)$obj as $key => $val){
 
   if(strcmp($key, "rest") == 0){
       foreach((array)$val as $restArray){
           //いいね変数
           $goods =0;

           //店舗IDを元にいいねがあるかの検索
           $sql = 'SELECT * FROM goods where gnavi_id = ?';
            $stmt = $db->prepare($sql);
            $rows = $stmt->execute([$restArray->{'id'}]);
           foreach ((array)$rows as $row) {
            $goods += $row['good'];
            }
?>
        <a href="shopinfo.php?shopid=<?php  if(checkString($restArray->{'id'}))   echo $restArray->{'id'};?>">
            <?php
            if(checkString($restArray->{'name'})) echo $restArray->{'name'};
           ?>
        </a>いいね数 <?php echo $goods ?><br>
        <?php
           if(checkString($restArray->{'image_url'}->{'shop_image1'})){
            ?><img src="<?php echo $restArray->{'image_url'}->{'shop_image1'} ?>"><br><?php
           }
        
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
?>

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
			<img src="img/back.jpg" class="responsive-img" style="height:300px;">
    <form action ="shoplistname.php" method="post">
    店舗名：<input type="text" name="shopname">
        <input type="submit" value="検索">
    </form>
    <?php $url = "shoplist.php"; ?>
    <script>
    function getPosition() {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    function successCallback(position) {    /* 成功時の処理 */
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        if(latitude){   /* 変数latitudeに値が入ってた時 */
            location.href = "<?php echo $url; ?>?lati=" + latitude + "&long=" + longitude;
        }
    }
    function errorCallback(error) { /* 失敗時の処理 */
        location.href = "<?php echo $url; ?>?alart=on";
    }
    }
</script>
    <button onclick="getPosition();">位置情報を元に検索</button>
    </body>
</html>
<?php
    $title = '見つける';
    $url = "shoprank.php";
?>
<?php include 'layout/header.php' ?>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">見つける</a>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="section">
                <h5>店舗名から検索する</h5>
                <form action ="shoprank.php" method="post">
                    <input type="text" name="shopname">
                </form>
            </div>
            <div class="section">
                <h5>現在地から検索する</h5>
                <a href="javascript:getPosition();" class="waves-effect waves-light btn">現在地から検索</a>
            </div>
        </div>
    </div>
</div>
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
<?php include 'layout/footer.php' ?>
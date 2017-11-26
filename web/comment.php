<?php
    $title = '登録';
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

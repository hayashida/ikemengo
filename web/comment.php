<?php

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
    <form enctype="multipart/form-data" action="mensinsert.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    コメント<input type="text" name="comment">
        <input type="hidden" name ="shopid" value = "<?php echo $_GET['shopid']; ?>">
    <input name="image" type="file" />
    <p><input type="submit" name="save" value="投稿" /><p>
    </form>
    </body>
</html>
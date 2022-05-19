<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピアプリ（入力画面）</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <form action="create.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>レシピの入力</legend>
            <a href="read.php">一覧画面</a>
            <div>
                タイトル: <input type="text" name="title">
            </div>
            <div>
                作り方: <input type="text" name="make">
            </div>

            <div id="input_pluralBox">
                <div id="input_plural">
                    材料：<input type="text" name="food" class="form-control" placeholder="にんじん">
                    <input type="button" name="food" value="＋" class="add pluralBtn">
                    <input type="button" name="food" value="－" class="del pluralBtn">
                </div>
            </div>
            <div>
                画像をアップロード: <input name="picture" type="file">

            </div>

            <div>
                <input type="submit" value="アップロード">
            </div>
        </fieldset>
    </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on("click", ".add", function() {
            $(this).parent().clone(true).insertAfter($(this).parent());
        });
        $(document).on("click", ".del", function() {
            var target = $(this).parent();
            if (target.parent().children().length > 1) {
                target.remove();
            }
        });
    </script>
    <!-- 
    <form method="POST" action="upimg.php" enctype="multipart/form-data">

        <input type="file" name="upimg" accept="image/*">
        <input type="submit"> -->

    </form>
</body>

</html>
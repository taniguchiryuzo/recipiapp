<?php

// （4）input="file"でpost送信された情報の受け取り
if (!empty($_FILES)) {

    // ファイル名を取得
    $filename = $_FILES['upload_image']['name'];

    //move_uploaded_file（第1引数：ファイル名,第2引数：格納後のディレクトリ/ファイル名）
    // 第2引数に使う部分
    $uploaded_path = 'images_after/' . $filename;
    //echo $uploaded_path.'<br>';

    $result = move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploaded_path);

    if ($result) {
        $MSG = 'アップロード成功！ファイル名：' . $filename;
        $img_path = $uploaded_path;
    } else {
        $MSG = 'アップロード失敗！エラーコード：' . $_FILES['upload_image']['error'];
    }
} else {
    $MSG = '画像を選択してください';
}
$title = $_POST['title'];
$make = $_POST['make'];
$food = $_POST['food'];
// $_FILES = $_POST['_FILES'];


// データ1件を1行にまとめる（最後に改行を入れる）
$write_data = "{$title} {$food} \n {$make}\n";


// ファイルを開く。引数が'a'である部分に注目！
$file = fopen('data/questionnaire.csv', 'a');

// ファイルをロックする
flock($file, LOCK_EX);

// 指定したファイルに指定したデータを書き込む
fwrite($file, $write_data,);

// ファイルのロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

$str = '';


$file = fopen('data/questionnaire.csv', 'r');
flock($file, LOCK_EX);

if ($file) {
    while ($line = fgets($file)) {
        $str .= "<tr><td>{$line}</td></tr> ";
    }
}

flock($file, LOCK_UN);
fclose($file);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>$_FILESの基本</title>
</head>

<body>

    <main>

        <section class="form-container">
            <div>
                <!--  メッセージを表示している箇所-->
                <p><?php if (!empty($MSG)) echo $MSG; ?></p>

                <!-- 画像を表示している箇所 -->
                <?= $str ?>
                <?php if (!empty($img_path)) {; ?>

                    <img src="<?php echo $img_path; ?>" alt="">

                <?php }; ?>
            </div>

            <!-- （1）formタグにenctype="multipart/form-data"を記載 -->
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    タイトル: <input type="text" name="title">
                </div>
                <div>
                    作り方: <input type="text" name="make">
                </div>

                <div id="input_pluralBox">
                    <div id="input_plural">
                        材料：<input type="text" name="food" class="form-control" placeholder="にんじん">
                        <input type="button" value="＋" class="add pluralBtn">
                        <input type="button" value="－" class="del pluralBtn">
                    </div>
                </div>
                <!-- （2）input 属性はtype="file" と指定-->
                <input type="file" name="upload_image">

                <!-- 送信ボタン -->
                <input type="submit" calss="btn_submit" value="送信">

            </form>
        </section>

        <section class="img-area">

            <?php
            if (!empty($img_path)) {  ?>
                <img src="echo <?php $img_path; ?>" alt="">
            <?php
            }
            ?>
        </section>

    </main>
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
    <?php
    $title = $_POST['title'];
    $make = $_POST['make'];
    $food = $_POST['food'];
    // $_FILES = $_POST['_FILES'];


    // データ1件を1行にまとめる（最後に改行を入れる）
    $write_data = "{$title} {$food} \n {$make}\n";


    // ファイルを開く。引数が'a'である部分に注目！
    $file = fopen('data/questionnaire.csv', 'a');

    // ファイルをロックする
    flock($file, LOCK_EX);

    // 指定したファイルに指定したデータを書き込む
    fwrite($file, $write_data,);

    // ファイルのロックを解除する
    flock($file, LOCK_UN);
    // ファイルを閉じる
    fclose($file);

    $str = '';


    $file = fopen('data/questionnaire.csv', 'r');
    flock($file, LOCK_EX);

    if ($file) {
        while ($line = fgets($file)) {
            $str .= "<tr><td>{$line}</td></tr> ";
        }
    }

    flock($file, LOCK_UN);
    fclose($file);
    ?>

</body>

</html>
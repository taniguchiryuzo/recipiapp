<?php
// var_dump($_POST);
// exit();

$file = $_FILES['picture'];

if (
    $file['type'] === 'image/jpeg' ||
    $file['type'] === 'image/png'
) {

    $path = 'images2/' . $file['name'];
    // var_dump($file);
    $success =  move_uploaded_file($file['tmp_name'], $path);

    if ($success) {
        echo '成功しました';
    } else {
        echo '失敗しました';
    }
} else {
    echo 'ファイル形式が不正です';
}

// データの受け取り
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


// データ入力画面に移動する
header("Location:input.php");

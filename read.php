<?php


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
    <title>レシピ集(一覧画面)</title>
</head>

<body>
    <fieldset>
        <legend>レシピ集</legend>
        <a href="input.php">入力画面</a>
        <table>
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?= $str ?>
                <?php
                if (!empty($path)) {  ?>
                    <!-- （5）ローカルフォルダに移動した画像を画面に表示する -->
                    <img src="echo <?php $path; ?>" alt="">
                <?php
                }
                ?>


            </tbody>
        </table>
    </fieldset>
</body>

</html>
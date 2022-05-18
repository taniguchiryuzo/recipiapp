<?php

// var_dump($_POST);
// exit();


$fp = fopen($_FILES['upimg']['tmp_name'], "rb");
$img = fread($fp, filesize($_FILES['upimg']['tmp_name']));
fclose($fp);

$enc_img = base64_encode($img);

$imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);

echo '<img src="data:' . $imginfo['mime'] . ';base64,' . $enc_img . '">';

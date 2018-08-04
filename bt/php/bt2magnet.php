<?php
header("Content-Type: text/html;charset=utf-8");

include 'BEncode.php';
include 'accessControl.php';
// if ($_FILES["file"]["error"] > 0)
// {
    // echo "错误：" . $_FILES["file"]["error"] . "<br>";
// }
// else
// {
    // echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
    // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
    // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];
// }
$torrent_content = file_get_contents($_FILES["file"]["tmp_name"]);
 
$desc = BDecode($torrent_content);
$info = $desc['info'];
$hash = strtoupper(sha1( BEncode($info) ));

echo '{"url":'.'"magnet:?xt=urn:btih:'.$hash.'"}';
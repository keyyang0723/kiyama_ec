<?php
$image_path = 'Users/kiyamayuu/develop/app/web/image';

var_dump($image_path);
// if (file_exists($image_path)) {
//     $fp   = fopen($image_path,'rb');
//     $size = filesize($image_path);
//     $img  = fread($fp, $size);
//     fclose($fp);

//     header('Content-Type: image/jpeg');
//     echo $img;
// }
$image_file = 'test.jpg';
if (file_exists($image_file)) {
  $size = filesize($image_file);
  header("Content-Length: $size");
  header("Content-type: image/jpeg");
  // 画像の出力関数と画像のフルパスを設定してみた
  readfile($image_path);
}

?>
<img src ="Users/kiyamayuu/develop/app/web/image/15.jpg"≥
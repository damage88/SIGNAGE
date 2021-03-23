<?php
//header ("Content-type: image/png");

$data['nom'] = 'Mambo';
$data['prenoms'] = 'Didier';
$data['sexe'] = 'Homme';
$data['surnom'] = 'Yorobo';
$data['morceau_prefere'] = 'Enfant bvéni';
$data['mot_prefere'] = 'Mannci';
$data['date_chinois'] = 'Yépélélé';
$data['type_chinois'] = 'Type 1';
$data['image'] = 'pp.jpg';
/*$data['date_chinois'] = 'Mambo';
$data['date_chinois'] = 'Mambo';
$data['date_chinois'] = 'Mambo';*/

$image = imagecreatefromjpeg("gabarit_cni.jpg");

$blanc = imagecolorallocate($image, 255, 255, 255);

imagestring($image, 5, 235, 155, utf8_decode($data['nom']) , $blanc);

imagestring($image, 5, 235, 200, utf8_decode($data['prenoms']) , $blanc);
imagestring($image, 5, 325, 200, utf8_decode($data['sexe']) , $blanc);
imagestring($image, 5, 235, 250, utf8_decode($data['surnom']) , $blanc);
imagestring($image, 5, 235, 300, utf8_decode($data['date_chinois']) , $blanc);

imagestring($image, 5, 425, 200, utf8_decode($data['type_chinois']) , $blanc);
imagestring($image, 5, 425, 250, utf8_decode($data['mot_prefere']) , $blanc);
imagestring($image, 5, 425, 300, utf8_decode($data['morceau_prefere']) , $blanc);






/*$filename = "pp.jpg";
$source = imagecreatefromjpeg($filename);
list($width, $height) = getimagesize($filename);

$newwidth = $width/5;
$newheight = $height/5;

$destination = imagecreatetruecolor($newwidth, $newheight);
imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($destination, "output.jpg", 100);*/

$im = imagecreatefromjpeg($data['image']);
$size = min(imagesx($im), imagesy($im));

$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size+(($size*10)/100)]);
if ($im2 !== FALSE) {
    imagejpeg($im2, 'cropped_'.$data['image']);
    imagedestroy($im2);
}
imagedestroy($im);

$filename = "cropped_".$data['image'];
$source = imagecreatefromjpeg($filename);
list($width, $height) = getimagesize($filename);

$newwidth = 138;//$width/5;
$newheight = 156;//$height/5;

$destination = imagecreatetruecolor($newwidth, $newheight);
imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($destination, "output_".$data['image'], 100);
imagedestroy($source);

$icon1 = imagecreatefromjpeg("output_".$data['image']);
$icon2 = imagecreatefrompng('water.png');
/*******/

imagecopy($image, $icon1, 72, 139, 0, 0, 138, 156);
imagecopy($image, $icon2, 30, 260, 0, 0, 194, 111);
/*******/
imagedestroy($icon1);
imagedestroy($icon2);


imagejpeg($image,'final_'.$data['image']);

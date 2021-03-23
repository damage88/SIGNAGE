<?php 
$__no_header = $__no_footer = true;

$data = $Model->extraireChamp('*', 'users', 'id='.$_GET['id_current']);

//header ("Content-type: image/png");

/*$data['nom'] = 'Mambo';
$data['prenoms'] = 'Didier';
$data['sexe'] = 'Homme';
$data['surnom'] = 'Yorobo';
$data['morceau_prefere'] = 'Enfant bvéni';
$data['mot_prefere'] = 'Mannci';
$data['date_chinois'] = 'Yépélélé';
$data['type_chinois'] = 'Type 1';
$data['image'] = 'pp.jpg';*/

/*$data['date_chinois'] = 'Mambo';
$data['date_chinois'] = 'Mambo';
$data['date_chinois'] = 'Mambo';*/

$image = imagecreatefromjpeg("controllers/gabarit_passeportb.jpg");

$blanc = imagecolorallocate($image, 255, 0, 0);

imagestring($image, 5, 100, 360, utf8_decode(strtoupper($data['nom'].' '.$data['prenoms'])) , $blanc);







/*$filename = "pp.jpg";
$source = imagecreatefromjpeg($filename);
list($width, $height) = getimagesize($filename);

$newwidth = $width/5;
$newheight = $height/5;

$destination = imagecreatetruecolor($newwidth, $newheight);
imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($destination, "output.jpg", 100);*/

$info = getimagesize('images/pics/'.$data['image']);
$extension = image_type_to_extension($info[2]);

if(strtolower($extension) == '.png'){
	$im = imagecreatefrompng('images/pics/'.$data['image']);
}elseif(strtolower($extension) == '.jpg' || strtolower($extension) == '.jpeg'){
	$im = imagecreatefromjpeg('images/pics/'.$data['image']);
}else{
	header('Location:.');
	exit;
}

$size = min(imagesx($im), imagesy($im));

$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size+(($size*10)/100)]);
if ($im2 !== FALSE) {
    imagejpeg($im2, 'images/pics/cropped_'.$data['image']);
    imagedestroy($im2);
}
imagedestroy($im);

$filename = "images/pics/cropped_".$data['image'];
$source = imagecreatefromjpeg($filename);
list($width, $height) = getimagesize($filename);

$newwidth = 150;//$width/5;
$newheight = 152;//$height/5;

$destination = imagecreatetruecolor($newwidth, $newheight);
imagecopyresampled($destination, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($destination, "images/pics/output_".$data['image'], 100);
imagedestroy($source);

$icon1 = imagecreatefromjpeg("images/pics/output_".$data['image']);
$icon2 = imagecreatefrompng('controllers/waterb2.png');
/*******/

imagecopy($image, $icon1, 83, 162, 0, 0, 149, 151);
imagecopy($image, $icon2, 83, 162, 0, 0, 149, 151);
/*******/
imagedestroy($icon1);
imagedestroy($icon2);


if(imagejpeg($image,'images/pics/passeport_'.$data['image'], 100)){
	header('Location:cni?code='.$data['code']);
	exit;
}else{
	header('Location:/');
	exit;
}


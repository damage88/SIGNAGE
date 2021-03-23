<?php 
header ("Content-type: image/png");

$im = imagecreatetruecolor(400, 30);

// Create some colors and set background to white.
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 29, $white);

// The text to draw
$text = 'Testing...';
// Replace path by your own font path
$font = 'Roboto-Medium.ttf';

// Add the text
imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im, 'gabarit_cni.png');
imagedestroy($im);
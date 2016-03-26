<?php
session_start();

$my_img = imageCreateFromPng("./icons/marker-icon-red-empty.png");
imageAlphaBlending($my_img, true);
imageSaveAlpha($my_img, true);

$overlayImage = imageCreateFromPng("../icon.png");
imageAlphaBlending($overlayImage, true);
imageSaveAlpha($overlayImage, true);

$overlayImageSmall = imageCreateTrueColor(19, 19);
imageSaveAlpha($overlayImageSmall, true);
$color = imageColorAllocateAlpha($overlayImageSmall, 0, 0, 0, 127);
imageFill($overlayImageSmall, 0, 0, $color);
imageCopyResampled($overlayImageSmall, $overlayImage, 0, 0, 0, 0, 19, 19, imagesx($overlayImage), imagesy($overlayImage));

imagecopy($my_img, $overlayImageSmall, 3, 5, 0, 0, imagesx($overlayImageSmall), imagesy($overlayImageSmall));

header("Content-type: image/png");
imagepng($my_img);
imageDestroy($my_img);

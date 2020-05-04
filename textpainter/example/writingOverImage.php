<?php

require_once '../class.textPainter.php';

$size = $_GET["size"];
$text = $_GET["text"];

echo "Hola";
$img = new textPainter('./certificado_participante2.png', $text, './Franklin.ttf', $size);

if(isset($_GET['x']) && isset($_GET['y'])){
    $img->setPosition($_GET['x'], $_GET['y']);
}

if(isset($_GET["r"]) && isset($_GET["g"]) && isset($_GET["b"])){
    $img->setTextColor($_GET["r"], $_GET["g"], $_GET["b"]);
}

$img->show();


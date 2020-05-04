<?php

function CargarPNG($imagen)
{
    /* Intentar abrir */
    $im = @imagecreatefrompng($imagen);

    /* Ver si falló */
    if(!$im)
    {
        /* Crear una imagen en blanco */
        $im  = imagecreatetruecolor(150, 30);
        $fondo = imagecolorallocate($im, 255, 255, 255);
        $ct  = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 150, 30, $fondo);

        /* Imprimir un mensaje de error */
        imagestring($im, 1, 5, 5, 'Error cargando ' . $imagen, $ct);
    }

    return $im;
}

header ('Content-Type: image/png');
// Crear la imagen usando la imagen base

$image = CargarPNG('certificado_participante2.png');
$image = imagecreatefrompng('cer/te.png');

// Asignar el color para el texto
$color = imagecolorallocate($image, 255, 255, 0);

// Asignar la ruta de la fuente
$font_path = 'Edwardian.ttf';

$text = "TEXTO DINAMICO EN IMAGEN"; // Texto 1
$text2 = "OTRA LINEA DE TEXTO CON PHP"; // Texto 2

/// imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
imagettftext($image, 0, 0, 0, 0, $color, $font_path, $text); // Colocar el texto 1 en la imagen
//imagettftext($image, 80, 0, 100, 1000, $color, $font_path, $text2); // Colocar el texto 2

imagepng($image); // Enviar el contenido al navegador

imagedestroy($image); // Limpiar la memoria


?>
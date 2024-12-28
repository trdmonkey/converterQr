<?php

require '../vendor/autoload.php';

use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\Png;

// Obtener el enlace desde el POST
$link = isset($_POST['link']) ? $_POST['link'] : '';

if (empty($link)) {
    echo json_encode([
        'op' => 'error',
        'message' => 'El campo link está vacío'
    ]);
    exit;
}

// Crear el QR Code
$renderer = new Png();
$renderer->setHeight(300);
$renderer->setWidth(300);
$writer = new Writer($renderer);

// Generar el QR como un string de imagen
$qrImage = $writer->writeString($link);

// Preparar la respuesta en formato base64
$respuesta = [
    'op' => 'ok',
    'file' => "data:image/png;base64," . base64_encode($qrImage)
];

echo json_encode($respuesta);


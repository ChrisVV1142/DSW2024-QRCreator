<?php
require '../vendor/autoload.php';
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Font\OpenSans; //Hay que importarla para usarla abajo
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data('Surprise, bitch! I bet you thought you had seen the last of me') //Código QR: poner web o texto
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(ErrorCorrectionLevel::High)
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
    // ->logoPath(__DIR__.'/assets/symfony.png')
    // ->logoResizeToWidth(50)     QUITAS ESO PARA QUE FUNCIONE SIN ERROR
    // ->logoPunchoutBackground(true)
    ->labelText('This is the label') //Lo que se ve abajo del QR
    ->labelFont(new OpenSans(12))
    ->labelAlignment(LabelAlignment::Center)
    ->validateResult(false)
    ->build();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Prueba</h1>
  <p>El texto</p>
  <p><img src="<?= $result->getDataUri() ?>" alt="codigo QR generado"></p>
</body>
</html>
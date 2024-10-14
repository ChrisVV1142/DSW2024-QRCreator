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

$data= $_POST['data'];
$label =$_POST['label'];
$imgName = $_POST['imgname'];

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($data) //Código QR: poner web o texto
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(ErrorCorrectionLevel::High)
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
    // ->logoPath(__DIR__.'/assets/symfony.png')
    // ->logoResizeToWidth(50)     QUITAS ESO PARA QUE FUNCIONE SIN ERROR
    // ->logoPunchoutBackground(true)
    ->labelText($label) //Lo que se ve abajo del QR
    ->labelFont(new OpenSans(12))
    ->labelAlignment(LabelAlignment::Center)
    ->validateResult(false)
    ->build();

    $result->saveToFile(__DIR__.'/img/'. $imgName . '.png')
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Creator</title>
</head>
<body>
  <h1>Código QR Generado</h1>
  <p><img src="<?= $result->getDataUri() ?>" alt="codigo QR generado"></p>
  <p><img src="img/<?= $imgName.'.png' ?>" alt="codigo QR generado"></p>
</body>
</html>
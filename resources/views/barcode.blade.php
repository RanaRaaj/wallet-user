<!DOCTYPE html>
<html>
<head>
    <title>Generate Bar Code in Laravel - W3Adda.com</title>
</head>
<body>

<br><br><br>
@php
    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
@endphp
<img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('123456789', $generatorPNG::TYPE_CODE_128)) }}">
</body>
</html>
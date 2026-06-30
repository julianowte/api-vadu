<?php
require '../vendor/autoload.php';
/*
site for access:
    https://www.vadu.com.br/
*/

use Julianowte\ApiVadu\Vadu;

//ADD AQUI SUAS CREDENCIAIS DO VADU
$token = 'xxxxxxxxxxxxxxx';

//DOCUMENTO QUE QUEIRA VERIFICAR: CPF, CNPJ numérico (formato antigo) ou CNPJ alfanumérico (formato novo)
$doc = 'xxxxxxxxxxx';        // CPF: 11 dígitos numéricos -> Ex: 123.456.789-09
// $doc = 'xx.xxx.xxx/xxxx-xx'; // CNPJ formato antigo: 14 dígitos numéricos -> Ex: 12.345.678/0001-95
// $doc = 'XX.XXX.XXX/XXXX-XX'; // CNPJ formato novo: 12 caracteres alfanuméricos + 2 dígitos verificadores -> Ex: 12.ABC.345/01DE-35

$Vadu = new Vadu();
echo $Vadu->getInfo($token, $doc);

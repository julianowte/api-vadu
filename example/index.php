<?php
require '../vendor/autoload.php';
/*
site for access:
    https://www.vadu.com.br/
*/

use Julianowte\ApiVadu\Vadu;

//ADD AQUI SUAS CREDENCIAIS DO VADU
$token = 'xxxxxxxxxxxxxxx';

//DOCUMENTO QUE QUEIRA VERIFICAR, CPF OU CNPJ
$doc = 'xxxxxxxxxxx';

$Vadu = new Vadu();
echo $Vadu->getInfo($token, $doc);

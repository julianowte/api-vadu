# api-vadu

Biblioteca PHP simples para integração com a API do [Vadu](https://www.vadu.com.br/), permitindo consultar dados de **CPF** e **CNPJ** (formato numérico antigo e o novo formato alfanumérico do CNPJ).

## Instalação

```bash
composer require julianowte/api-vadu
```

## Uso

```php
require 'vendor/autoload.php';

use Julianowte\ApiVadu\Vadu;

$token = 'SEU_TOKEN_VADU';
$doc = '123.456.789-09'; // CPF, CNPJ antigo ou CNPJ novo (alfanumérico)

$Vadu = new Vadu();
echo $Vadu->getInfo($token, $doc);
```

Veja um exemplo completo em [example/index.php](example/index.php).

## Documentos suportados

A biblioteca aceita o documento formatado ou apenas com os caracteres alfanuméricos, e detecta automaticamente o tipo de consulta a partir do conteúdo informado:

| Documento | Formato | Exemplo |
|---|---|---|
| CPF | 11 dígitos numéricos | `123.456.789-09` |
| CNPJ (formato antigo) | 14 dígitos numéricos | `12.345.678/0001-95` |
| CNPJ (formato novo) | 12 caracteres alfanuméricos + 2 dígitos verificadores | `12.ABC.345/01DE-35` |

O novo formato de CNPJ alfanumérico, definido pela Receita Federal, é aceito automaticamente: pontuação é removida e as letras são normalizadas para maiúsculas antes do envio à API.

## Retorno

O método `getInfo` sempre retorna uma string JSON no formato:

```json
{
    "data": { ... },
    "error": []
}
```

Em caso de falha na requisição, o HTTP status `400` é definido e o campo `error` é preenchido com os detalhes da requisição e da resposta.

<?php

namespace Julianowte\ApiVadu;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Vadu
{
    private array $urlapi = array(
        1 => 'https://www.vadu.com.br/vaduIntegracao.dll/ServicoAnaliseOperacao/ConsultaPF',
        2 => 'https://www.vadu.com.br/vadu.dll/ServicoAnaliseOperacao/ConsultaPF',
        3 => 'https://www.vadu.com.br/vaduIntegracao.dll/ServicoAnaliseOperacao/Consulta'
    );

    public $end_point;

    public function __construct(
        private Client $client = new Client
    ) {}

    public function getInfo(string $token, string $doc): string
    {
        try {
            $doc = preg_replace("/\D+/", '', $doc);
            if (strlen($doc) == 11) {
                $this->end_point = 1;
            } else {
                $this->end_point = 3;
            }

            $res = $this->client->request('GET', $this->urlapi[$this->end_point] . "/" . $doc, [
                'headers' => [
                    "Authorization" => "Bearer " . $token
                ]
            ]);

            $body = $res->getBody();
            $body = json_decode($body, true);
            return json_encode([
                "data" => $body,
                "error" => []
            ]);
        } catch (RequestException $e) {
            $error['error'] = $e->getMessage();
            $error['request'] = Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                $error['response'] = Psr7\Message::toString($e->getResponse());
            }
            http_response_code(400);
            return json_encode([
                "data" => "",
                "error" => $error
            ]);
        }
    }
}

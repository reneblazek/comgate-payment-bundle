<?php


namespace Mufin\ComgateBundle\Service;

use GuzzleHttp\Client;
use Mufin\ComgateBundle\Helper\CreatePaymentResponse;
use Mufin\ComgateBundle\Helper\RequestInterface;


class ComgateConnector
{
    private $params;

    /**
     * @var Client
     */
    private $client;

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->client = new Client([
            'base_uri' => 'https://payments.comgate.cz/v1.0/'
        ]);
    }

    /**
     * @param Client $client
     * @return ComgateConnector
     */
    public function setClient(Client $client): ComgateConnector
    {
        $this->client = $client;
        return $this;
    }


    /**
     * @param RequestInterface $request
     * @return CreatePaymentResponse
     */
    public function send(RequestInterface $request)
    {
        $baseParams = [
            'merchant' => $this->params["merchant"],
            'test' => $this->params["test"] ? 'true' : 'false',
            'secret' => $this->params["secret"]
        ];

        if ($request->isPost()) {
            $response = $this->client->request('POST', $request->getEndPoint(), [
                'form_params' => $baseParams + $request->getData()
            ]);
        } else {
            $response = $this->client->request('GET', $request->getEndPoint(), [
                'query' => $baseParams + $request->getData()
            ]);
        }

        $body = (string)$response->getBody();
        parse_str($body, $data);
        $responseClass = $request->getResponseClass();

        return new $responseClass($data);
    }

}
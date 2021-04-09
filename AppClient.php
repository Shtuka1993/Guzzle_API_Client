<?php
    use GuzzleHttp\Client;
    include('ClientLogger.php');
    
    class AppClient {
        
        const API_DOC = 'https://docs.thecatapi.com';
        const API_URL = 'https://api.thecatapi.com';
        const GET_CAT_API_ENDPOINT = '/v1/images/search';
        const API_KEY = '761a9168-5e3e-4e20-9a98-b8f88ed3d91d';
        const API_QUERY_PARAMETER = 'api_key';
        const API_HEADER_AUTHENTIFICATION = 'x-api-key';

        private $client;

        public function __construct() {
            $this->client = new Client([
                // Base URI is used with relative requests
                'base_uri' => self::API_URL,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
        }
    
        public function getRequest() {
            $request = ['method' => 'GET',
                'base_uri' => self::API_URL, 
                'endpoint' => self::GET_CAT_API_ENDPOINT, 
                'parameters' => [
                //'body' => [],
                    'query' => [
                        'limit' => '1', 
                        'size' => 'full'
                    ],
                    'headers' => [
                        self::API_HEADER_AUTHENTIFICATION => self::API_KEY
                    ]
                ]
            ];       

            $response = $this->client->request($request['method'], $request['endpoint'], $request['parameters']);

            $clientLogger = new ClientLogger();
            $clientLogger->loggRequest($request);
        
            $body = $response->getBody();
            //$parsed = Request::parseHeader($response);
            $data = json_decode((string)$body); 
        
            //Code for Logger
            $clientLogger->loggRequest($request);
            $clientLogger->loggResponse($body);
        
            return $data;
        }
    
    }
?>
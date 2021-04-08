<?php
    use GuzzleHttp\Client;
    
    class AppClient {
        
        const API_DOC = 'https://docs.thecatapi.com';
        const API_URL = 'https://api.thecatapi.com';
        const GET_CAT_API_ENDPOINT = '/v1/images/search';
        const API_KEY = '761a9168-5e3e-4e20-9a98-b8f88ed3d91d';
        const API_QUERY_PARAMETER = 'api_key';
        const API_HEADER_AUTHENTIFICATION = 'x-api-key';

        private $client;

        public function __constructor() {
            $this->client = new Client([
                // Base URI is used with relative requests
                'base_uri' => API_URL,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);
        }
    
        public function getRequest() {
            $response = $client->request('GET', GET_CAT_API_ENDPOINT, [
                //'body' => [],
                'query' => [
                    'limit' => '1', 
                    'size' => 'full'
                ],
                'headers' => [
                    API_HEADER_AUTHENTIFICATION => API_KEY
                ]
            ]);
        
            $body = $response->getBody();
            //$parsed = Request::parseHeader($response);
            $data = json_decode((string)$body); 
        
            //Code for Logger
        
            var_dump($data);
        
            foreach($data as $item) {
                echo "<img src='".$item->url."'>";
            }
        }
    
    }
?>
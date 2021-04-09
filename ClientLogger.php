<?php
    use GuzzleHttp\HandlerStack;
    use GuzzleHttp\Middleware;
    use GuzzleHttp\MessageFormatter;
 
    use Monolog\Logger;
    use Monolog\Formatter\LineFormatter;
    use Monolog\Handler\StreamHandler;

    class ClientLogger {
        private $logger;
        private $guzzleHandler;
        private $requestHandler;
        private $responseHandler;

        public function __construct() {
            $this->logger = new Logger('GuzzleLogger');
            $formatter = new LineFormatter(null, null, false, true);
            $this->guzzleHandler = new StreamHandler('logs/guzzle.log');
            $this->guzzleHandler->setFormatter($formatter);
            $this->requestHandler = new StreamHandler('logs/request.log');
            $this->requestHandler->setFormatter($formatter);
            $this->responseHandler = new StreamHandler('logs/response.log');
            $this->responseHandler->setFormatter($formatter);
        }

        public function loggRequest($request) {
            $this->logger->pushHandler($this->requestHandler);
            $this->logger->debug($request);
        }

        public function loggResponse($body) {
            $this->logger->pushHandler($this->responseHandler);
            $this->logger->debug($body);
        }
    }
?>

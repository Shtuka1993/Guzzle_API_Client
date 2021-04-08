<?php
    use GuzzleHttp\HandlerStack;
    use GuzzleHttp\Middleware;
    use GuzzleHttp\MessageFormatter;
 
    use Monolog\Logger;
    use Monolog\Formatter\LineFormatter;
    use Monolog\Handler\StreamHandler;

    class ClientLogger {
        private $logger;

        public function __constructor() {
            $this->logger = new Logger('GuzzleLogger');
            $formatter = new LineFormatter(null, null, false, true);
            $this->guzzleHandler = new StreamHandler('logs/guzzle.log');
            $this->guzzleHandler->setFormatter($formatter);
        }

        public function logRequest($request) {
            
        }

        public function logResponse($body) {
            $logger->pushHandler($guzzleHandler);
            $logger->debug($body);
        }
    }
?>

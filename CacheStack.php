<?php
    use GuzzleHttp\HandlerStack;
    use League\Flysystem\Filesystem;
    use League\Flysystem\Local\LocalFilesystemAdapter;
    use Kevinrob\GuzzleCache\CacheMiddleware;
    use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
    use Kevinrob\GuzzleCache\Storage\FlysystemStorage;
 
    class CacheStack {
        private $stack;

        public function __construct() {
            $this->$stack = HandlerStack::create();
            $adapter = new LocalFilesystemAdapter("/local/cache");
            $this->$stack->push(
                new CacheMiddleware(
                    new PrivateCacheStrategy(
                        $adapter
                    )
                ), 
                "cache"
            );
        }
    }
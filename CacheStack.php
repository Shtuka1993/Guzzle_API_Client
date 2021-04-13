<?php
    use GuzzleHttp\HandlerStack;
    use Kevinrob\GuzzleCache\CacheMiddleware;
    /*use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter\Local;*/
    //use Doctrine\
    use Doctrine\Common\Cache\FilesystemCache;
    use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;
    use Kevinrob\GuzzleCache\Storage\DoctrineCacheStorage;
 
    class CacheStack {
        const CACHE_STORAGE = __DIR__."/local/cache/";
        private $stack;

        public function __construct() {
            $this->stack = HandlerStack::create();
            /*$adapter = new Local("/local/cache");
            $this->$stack->push(
                new CacheMiddleware(
                    new PrivateCacheStrategy(
                        new FlysystemStorage($adapter)
                    )
                ), 
                "cache"
            );*/
            $this->stack->push(
                new CacheMiddleware(
                  new PrivateCacheStrategy(
                    new DoctrineCacheStorage(
                      new FilesystemCache(self::CACHE_STORAGE)
                    )
                  )
                ),
                'cache'
              );
        }

        public function getStack() {
            return $this->stack;
        }
    }
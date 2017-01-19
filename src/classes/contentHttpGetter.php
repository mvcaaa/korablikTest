<?php
/**
 * Created by Astashov Andrey <mvc.aaa@gmail.com>
 * Date: 19.01.2017 / 20:20
 */

namespace src\classes;

use src\interfaces\contentGetterInterface;
use GuzzleHttp\Client;


/**
 * Class contentHttpGetter
 * @package src\classes
 */
class contentHttpGetter implements contentGetterInterface
{

    private $url = "";
    
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * contentHttpGetter constructor.
     *
     * Skipping input url string for now
     * @param string $url
     */
    public function __construct(string $url = "")
    {
        if (!empty($url))
            $this->url = $url;
    }

    /**
     * @param string $url
     * @return mixed
     * @throws \Exception
     */
    public function retrieve(string $url = "")
    {
        if (!empty($url))
            $this->setUrl($url);

        if (empty($this->getUrl()))
            return 'app error: <url> must be set';

        try {
            // TODO implement caching
            $c = new Client(['timeout' => 10.0]);
            $r = $c->get($this->getUrl())->getBody()->getContents();
        } catch (\Exception $e) {
            $r = $e->getMessage();
        }

        return $r;
    }
}
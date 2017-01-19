<?php
/**
 * Created by Astashov Andrey <mvc.aaa@gmail.com>
 * Date: 19.01.2017 / 22:52
 */

namespace src\classes;


use src\interfaces\contentGetterInterface;
use src\interfaces\contentParserInterface;

class app
{
    /**
     * @var contentReplaceParser
     */
    private $parser;
    
    /**
     * @var contentHttpGetter
     */
    private $getter;

    /**
     * @var string
     */
    private $url;
    /**
     * @var array
     */
    private $content;

    public function __construct($url = '', contentGetterInterface $getter, contentParserInterface $parser)
    {
        $this->getter = $getter;
        $this->parser = $parser;
        if (!empty($url)) {
            $this->setUrl($url);
            $this->getter->setUrl($url);
        }

    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        if (!empty($this->getUrl() && !empty($this->getter)))
            $this->content[] = $this->getter->retrieve();
        return end($this->content);
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->getter->setUrl($url);
        $this->url = $url;
    }

    public function processOnce($search, $replace)
    {
        $this->parser->setCurrentContent($this->getContent());
        $this->content = array_merge($this->content, $this->parser->parseSingleEntry($search, $replace));
    }

    public function processMultiple($values)
    {
        $this->parser->setCurrentContent($this->getContent());
        $this->content = array_merge($this->content, $this->parser->parseMultiEntry($values));
    }

    public function printResults()
    {
        var_export($this->content);
    }

    public function results()
    {
        return $this->content;
    }
        
}
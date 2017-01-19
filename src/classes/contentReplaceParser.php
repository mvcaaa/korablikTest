<?php
/**
 * Created by Astashov Andrey <mvc.aaa@gmail.com>
 * Date: 19.01.2017 / 21:25
 */

namespace src\classes;


use src\interfaces\contentParserInterface;

class contentReplaceParser implements contentParserInterface
{
    private $currentContent;
    private $results = array();

    public function __construct(string $content = "")
    {
        if (!empty($content)) {
            $this->setCurrentContent($content);
            $this->setResults($content);
        } 
    }

    /**
     * @return mixed
     */
    public function getCurrentContent()
    {
        return $this->currentContent;
    }

    /**
     * @param mixed $currentContent
     */
    public function setCurrentContent($currentContent)
    {
        $this->currentContent = $currentContent;
    }

    /**
     * @param string $search
     * @param string $replace
     * @return mixed
     */
    public function parseSingleEntry(string $search, string $replace)
    {
        $this->setResults($this->strReplaceRecursive($search, $replace));
        return $this->getResults();
    }

    /**
     * @param array $values
     * @internal param array $params
     * @return bool
     */
    public function parseMultiEntry(array $values)
    {
        foreach ($values as $value)
            $this->setResults($this->strReplaceRecursive($value[0], $value[1]));
        
        return $this->getResults();
    }


    /**
     * @param $value
     * @param $replace
     * @return mixed
     */
    public function strReplaceRecursive($value, $replace)
    {
        while (strpos($this->getCurrentContent(), $value) !== false) {
            $this->setCurrentContent(str_replace($value, $replace, $this->getCurrentContent()));
            $this->strReplaceRecursive($value, $replace);
        }
        return $this->getCurrentContent();
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $results
     */
    public function setResults($results)
    {
        $this->results[] = $results;
    }


}
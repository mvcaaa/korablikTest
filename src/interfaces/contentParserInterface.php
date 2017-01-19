<?php
/**
 * Created by Astashov Andrey <mvc.aaa@gmail.com>
 * Date: 19.01.2017 / 20:12
 */

namespace src\interfaces;

/**
 * Interface contentParserInterface
 * @package src
 */
interface contentParserInterface {
    /**
     * @param string $search
     * @param string $replace
     * @return mixed
     */
    public function parseSingleEntry(string $search, string $replace);

    /**
     * @param array $values
     * @return array
     */
    public function parseMultiEntry(array $values);
}
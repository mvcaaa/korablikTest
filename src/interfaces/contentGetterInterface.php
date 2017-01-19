<?php
/**
 * Created by Astashov Andrey <mvc.aaa@gmail.com>
 * Date: 19.01.2017 / 20:08
 */
namespace src\interfaces;

/**
 * Interface contentGetterInterface
 * @package src
 */
interface contentGetterInterface {
    /**
     * @param string $url
     * @return mixed
     */
    public function retrieve(string $url);
}
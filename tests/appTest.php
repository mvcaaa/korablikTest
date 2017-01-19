<?php
/**
 * Created by Astashov Andrey <mvc.aaa@gmail.com>
 * Date: 19.01.2017 / 23:20
 */

namespace tests;


use src\classes\app;
use src\classes\contentHttpGetter;
use src\classes\contentReplaceParser;


class appTest extends \PHPUnit_Framework_TestCase
{
    public function testAppProcessOnce()
    {
        $url = "https://gist.githubusercontent.com/mvcaaa/b8bf4511bc59eca60bde9092e6a93823/raw/845edf1a6c2a7fcc3e49daa5f42cc6b7f6d8284c/test.html";
        $app = new app($url, new contentHttpGetter(), new contentReplaceParser());
        $app->processOnce(" ", "_");
        $this->assertContains('This_is_a_test_file', $app->results());
        $this->assertContains('This is a test file', $app->results());
    }

    public function testAppProcessMultiple()
    {
        $url = "https://gist.githubusercontent.com/mvcaaa/b8bf4511bc59eca60bde9092e6a93823/raw/845edf1a6c2a7fcc3e49daa5f42cc6b7f6d8284c/test.html";
        $app = new app($url, new contentHttpGetter(), new contentReplaceParser());
        $app->processMultiple([[" ", "_"], ["_", "--"]]);
        $this->assertContains('This--is--a--test--file', $app->results());
        $this->assertContains('This_is_a_test_file', $app->results());
        $this->assertContains('This is a test file', $app->results());
    }

}

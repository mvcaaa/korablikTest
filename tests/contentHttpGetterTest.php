<?php
/**
 * Created by Astashov Andrey <mvc.aaa@gmail.com>
 * Date: 19.01.2017 / 20:31
 */

namespace tests;


use src\classes\contentHttpGetter;


class contentHttpGetterTest extends \PHPUnit_Framework_TestCase
{
    public function testURL()
    {
        $request = new contentHttpGetter("http://www.yandex.ru");
        $this->assertEquals("http://www.yandex.ru", $request->getUrl());
    }

    public function testSetURL()
    {
        $request = new contentHttpGetter();
        $request->setUrl("http://www.yandex.ru");

        $this->assertEquals("http://www.yandex.ru", $request->getUrl());
    }

    public function testRetrieveWithEmptyURL()
    {
        $request = new contentHttpGetter();
        $result = $request->retrieve();
        $this->assertContains("app error", $result);
    }

    public function testRetrieve()
    {
        $request = new contentHttpGetter();
        $result = $request->retrieve("https://gist.githubusercontent.com/mvcaaa/b8bf4511bc59eca60bde9092e6a93823/raw/845edf1a6c2a7fcc3e49daa5f42cc6b7f6d8284c/test.html");
        $this->assertInternalType('string', $result);
        $this->assertNotEmpty($result);
        $this->assertContains("This is a test file", $result);
    }

    public function testRetrieveWrongURL()
    {
        $request = new contentHttpGetter("/dev/null");
        $result = $request->retrieve();
        $this->assertContains("cURL error", $result);
    }

}

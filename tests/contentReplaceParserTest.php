<?php
/**
 * Created by Astashov Andrey <mvc.aaa@gmail.com>
 * Date: 19.01.2017 / 22:09
 */

namespace tests;


use src\classes\contentReplaceParser;


class contentReplaceParserTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleReplace()
    {
        $parser = new contentReplaceParser("This is a test This");
        $this->assertEquals("It is a test It", $parser->strReplaceRecursive("This", "It"));
    }

    public function testRecursiveReplace()
    {
        $parser = new contentReplaceParser('one__two_____three');
        $this->assertEquals("one_two_three", $parser->strReplaceRecursive("__", "_"));
    }

    public function testParseSingleEntry()
    {
        $parser = new contentReplaceParser('one__two_____three');
        $this->assertEquals(['one__two_____three', 'one_two_three'], $parser->parseSingleEntry("__", "_"));
    }

    public function testParseMultiEntry()
    {
        $parser = new contentReplaceParser('one__two_____three');
        $replace_arr = [["__", "_"], ["_", " "]];
        $this->assertEquals(['one__two_____three', 'one_two_three', 'one two three'], $parser->parseMultiEntry($replace_arr));
    }


}

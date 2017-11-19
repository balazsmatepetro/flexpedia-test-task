<?php

namespace Flexpedia\Test;

use PHPUnit\Framework\TestCase;
use Flexpedia\CsvOutput;

/**
 * Description of CsvOutputTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class CsvOutputTest extends TestCase
{
    public function testRender()
    {
        $data = [
            [1, 'String', 10.0],
            [true, '1', 2],
            ["'10'", "'String'", 10]
        ];

        $csv = CsvOutput::render($data, ',', '"');

        $lines = explode("\n", $csv);

        $this->assertEquals('1,String,10', $lines[0]);
        $this->assertEquals('1,1,2', $lines[1]);
        $this->assertEquals("'10','String',10", $lines[2]);
    }
}

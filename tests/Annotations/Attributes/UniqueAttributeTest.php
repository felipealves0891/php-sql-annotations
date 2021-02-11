<?php
declare(strict_types=1);

namespace Tests\Annotations\Attributes;

use Tests\TestCase;
use Annotations\Annotations\Attributes\UniqueAttribute;

class UniqueAttributeTest extends TestCase
{
    public function testToString()
    {
        $type = "Unique";
        $params = null;
        $expected = ' unique';

        $unique = new UniqueAttribute($type, $params);
        $this->assertEquals($expected, strval($unique));
    }

    public function testInvalidType() 
    {
        $this->expectException(\InvalidArgumentException::class);

        $type = "Default";
        $params = ["Now"];
        $unique = new UniqueAttribute($type, $params);
    }

    public function testInvalidParams() 
    {
        $this->expectException(\InvalidArgumentException::class);

        $type = "Unique";
        $params = [];
        $unique = new UniqueAttribute($type, $params);
    }
}

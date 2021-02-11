<?php
declare(strict_types=1);

namespace Tests\Annotations\Attributes;

use Tests\TestCase;
use Annotations\Annotations\Attributes\DefaultAttribute;

class DefaultAttributeTest extends TestCase
{
    public function testToString() 
    {
        $type = "Default";
        $params = ["Now"];
        $expected = " default 'now'";

        $default = new DefaultAttribute($type, $params);
        $this->assertEquals($expected, strval($default));
    }

    public function testToStringWithFunction() 
    {
        $type = "Default";
        $params = ["GetDate()", "Function"];
        $expected = " default (getdate())";

        $default = new DefaultAttribute($type, $params);
        $this->assertEquals($expected, strval($default));
    }

    public function testInvalidType()
    {
        $this->expectException(\InvalidArgumentException::class);

        $type = "table";
        $params = ["GetDate()", "Function"];
        $default = new DefaultAttribute($type, $params);
    }

    public function testInvalidParams()
    {
        $this->expectException(\InvalidArgumentException::class);

        $type = "default";
        $params = "GetDate()";
        $default = new DefaultAttribute($type, $params);
    }
}

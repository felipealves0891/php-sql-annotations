<?php
declare(strict_types=1);

namespace Tests\Annotations\Attributes;

use Tests\TestCase;
use Annotations\Annotations\Attributes\TypeAttribute;

class TypeAttributeTest extends TestCase
{
    public function testToString()
    {
        $type = "type";
        $params = ["String", 250];
        $expected = ' varchar(250)';

        $columnType = new TypeAttribute($type, $params);
        $this->assertEquals($expected, strval($columnType));
    }
}

<?php
declare(strict_types=1);

namespace Tests\Annotations\Attributes;

use Tests\TestCase;
use Annotations\Annotations\Attributes\IdentityAttribute;

class IdentityAttributeTest extends TestCase
{
    public function testToString() 
    {
        $type = "Identity";
        $params = ['100','1'];
        $expected = " identity(100,1)";

        $identity = new IdentityAttribute($type, $params);
        $this->assertEquals($expected, strval($identity));
    }

    public function testInvalidType() 
    {
        $this->expectException(\InvalidArgumentException::class);
        $type = "unique";
        $params = [100,1];
        $identity = new IdentityAttribute($type, $params);
    }
    
    public function testInvalidParams() 
    {
        $this->expectException(\InvalidArgumentException::class);

        $type = "Identity";
        $params = [100,'a'];
        $identity = new IdentityAttribute($type, $params);
    }

    public function testInvalidParams2() 
    {
        $this->expectException(\InvalidArgumentException::class);

        $type = "Identity";
        $params = [100,1,100];
        $identity = new IdentityAttribute($type, $params);
    }
}


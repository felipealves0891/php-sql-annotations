<?php
declare(strict_types=1);

namespace Tests\Annotations\Entities;

use PHPUnit\Framework\TestCase;
use Annotations\Annotations\Annotation;
use Annotations\Annotations\Entities\Propert;
use Annotations\Annotations\Attributes\TypeAttribute;
use Annotations\Annotations\Attributes\IdentityAttribute;

class PropertTest extends TestCase
{
    public function testToString() 
    {
        $name = "Id";
        $attrType = $this->getAttrType();
        $attrIdentity = $this->getAttrIdentity(); 
        $expected = "[Id] int identity(1000,1)";

        $property = new Propert($name, [$attrType, $attrIdentity]);

        $this->assertEquals($expected, strval($property));
    }  

    private function getAttrType() 
    {
        $type = "type";
        $params = ["int"];
        return new TypeAttribute($type, $params);
    }

    private function getAttrIdentity() 
    {
        $type = "Identity";
        $params = ['1000','1'];
        return new IdentityAttribute($type, $params);
    }
}

<?php
declare(strict_types=1);

namespace Tests\Annotations\Entities;

use Tests\TestCase;
use Annotations\Annotations\Annotation;
use Annotations\Annotations\Entities\Entity;
use Annotations\Annotations\Entities\Propert;
use Annotations\Annotations\Attributes\TypeAttribute;
use Annotations\Annotations\Attributes\UniqueAttribute;
use Annotations\Annotations\Attributes\DefaultAttribute;
use Annotations\Annotations\Attributes\IdentityAttribute;

class EntityTest extends TestCase
{
    public function testToString() 
    {
        $type = "Class";
        $name = "Entities";
        $schema = "dbo";
        $properties = $this->getProperties();
        $expected = "create table [dbo].[Entities] ([Id] int identity(1,1), [Name] varchar(255) unique, [BirthDay] datetime default (getdate()))";

        $entity = new Entity($type, [$schema, $name, $properties]);
        $this->assertEquals($expected, strval($entity));
    }

    public function testToStringWithoutSchema() 
    {
        $type = "Class";
        $name = "Entities";
        $schema = "";
        $properties = $this->getProperties();
        $expected = "create table [Entities] ([Id] int identity(1,1), [Name] varchar(255) unique, [BirthDay] datetime default (getdate()))";

        $entity = new Entity($type, [$schema, $name, $properties]);
        $this->assertEquals($expected, strval($entity));
    }

    private function getProperties() 
    {
        $attrs = [];
        $attrs["Id"] = [new TypeAttribute('type', ["int"]),  new IdentityAttribute('identity')];
        $attrs["Name"] = [new TypeAttribute('type', ["string", 255]),  new UniqueAttribute('unique')];
        $attrs["BirthDay"] = [new TypeAttribute('type', ["datetime"]),  new DefaultAttribute('default', ['getdate()', 'function'])];

        return [
            new Propert("Id", $attrs["Id"]),
            new Propert("Name", $attrs["Name"]),
            new Propert("BirthDay", $attrs["BirthDay"]),
        ];
    }

}

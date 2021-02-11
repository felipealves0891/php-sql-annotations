<?php
declare(strict_types=1);

namespace Tests\Annotations\Attributes;

use Tests\TestCase;
use Annotations\Annotations\Attributes\FormAttribute;

class FormAttributeTest extends TestCase 
{
    public function testToString() 
    {
        $type = "form";
        $params = ['type="date"', 'id="tBirth"', 'placerolder="Datadenascimento"', 'required="true"'];    
        $expected = '<input type="date" id="tBirth" placerolder="Datadenascimento" required="true" />';

        $input = new FormAttribute($type, $params);
        $this->assertEquals($expected, strval($input));
    } 

}

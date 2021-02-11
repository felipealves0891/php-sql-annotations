<?php
declare(strict_types=1);

namespace Tests\Engine;

use Tests\TestCase;
use Annotations\Engine\Engine;

class EngineTest extends TestCase
{
    public function providerAnnotations() 
    {
        return [
            ['Tests\Engine\Entity','{"class":{"Table":"Entities","Schema":"dbo","property":{"id":{"Attr":"Identity","Type":"Int"},"name":{"Attr":"Unique","Type":"String"},"birthDay":{"Type":"Datetime","Attr":["Default","GetDate()","Function"]}}}}']    
        ];
    }

    /**
     * @dataProvider providerAnnotations
     */
    public function testStart($classname, $expected)
    {
        $engine = Engine::Start($classname);
        $annotations = $engine->process();

        $this->assertEquals($expected, json_encode($annotations));
    }

}


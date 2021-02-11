<?php
declare(strict_types=1);

namespace Tests\Annotations;

use Tests\TestCase;
use Annotations\Annotations\Annotation;

class AnnotationTest extends TestCase
{   
    public function testToString() 
    {
        $type = "test";
        $params = ['the', 'attribute', 'class'];
        $expected = 'test the attribute class';

        $attr = $this->getAttribute($type, $params);
        $this->assertEquals($expected, strval($attr));

    }

    public function testInvalidType() 
    {
        $type = "invalid";

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Tipo '$type' invalido para a respectiva classe!");
        $this->getAttribute($type, []);
    }

    public function testInvalidParam() 
    {
        $type = "test";

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Parametros invalidos para o tipo '$type'");
        $this->getAttribute($type, 'parameter');
    }

    private function getAttribute($type, $params) : Annotation
    {
        return new class($type, $params) extends Annotation
        {
            public function __construct(string $type, $params){
                parent::__construct($type, $params);
            }

            public function __toString()
            {
                return $this->type . ' ' . \implode(' ', $this->params);
            }

            /**
             * @inheritdoc
             */
            protected function validateType(string $type) : bool
            {
                return $type == 'test';
            }

            /**
             * @inheritdoc
             */
            protected function  validateParams($params) : bool
            {
                return \is_array($params);
            }
        };
    }
}

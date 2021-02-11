<?php
declare(strict_types=1);

namespace Annotations\Annotations\Entities;

use Annotations\Annotations\Annotation;

class Entity extends Annotation 
{
    /**
     * @inheritdoc
     */
    protected function validateType(string $type) : bool
    {
        return strtolower($type) == "class";
    }

    /**
     * @inheritdoc
     */
    protected function validateParams($params) : bool
    {
        if(\count($params) != 3 && !is_array($params[2]))
            return false;

        $properties = array_filter($params[2], fn($value) => ($value instanceof Annotation));
        if(count($properties) != count($params[2]))
            return false;

        return true;
    }

    public function __toString()
    {
        $schema = empty($this->params[0]) ? "" : "[" . $this->params[0] . "].";
        $name = "[" . $this->params[1] . "]";
        $properties = implode(', ', $this->params[2]);

        return "create table {$schema}{$name} ({$properties})";
    }
}

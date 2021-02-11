<?php
declare(strict_types=1);

namespace Annotations\Annotations\Attributes;

use Annotations\Annotations\Annotation;

class TypeAttribute extends Annotation
{

    private $validTypes = [
        "string" => "varchar",
        "int" => "int",
        "bigint" => "bigint",
        "float" => "float",
        "numeric" => "numeric",
        "datetime" => 'datetime'
    ];

    /**
     * @inheritdoc
     */
    protected function validateType(string $type) : bool
    {
        return strtolower($type) == 'type';
    }

    /**
     * @inheritdoc
     */
    protected function validateParams($params) : bool
    {
        if(!is_array($params))
            return false;
            
        if(empty($params))
            return false;

        if(!count($params) > 2)
            return false;
        
        if(isset($params[1]) && !is_numeric($params[1]))
            return false;

        foreach ($this->validTypes as $key => $type)
            if(strtolower($params[0]) == $key)
                return true;

        return false;
    }

    public function __toString()
    {
        $key = strtolower($this->params[0]);
        $columnType = $this->validTypes[$key];

        if(count($this->params) == 1)
            return " $columnType";

        $length = $this->params[1];
        return " $columnType($length)";
    }
}


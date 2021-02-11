<?php
declare(strict_types=1);

namespace Annotations\Annotations\Attributes;

use Annotations\Annotations\Annotation;

class IdentityAttribute extends Annotation 
{
    /**
     * @inheritdoc
     */
    protected function validateType(string $type) : bool
    {
        return strtolower($type) == 'identity';
    }

    /**
     * @inheritdoc
     */
    protected function validateParams($params) : bool
    {
        if(empty($params))
            return true;

        if(count($params) > 2)
            return false;

        $numbers = array_filter($params, 'is_numeric');
        if(count($numbers) != count($params))
            return false;

        return true;
    }

    public function __toString() 
    {
        $seed = isset($this->params[0]) ? $this->params[0]: 1;
        $increment = isset($this->params[1]) ? $this->params[1]: 1;
        return " identity($seed,$increment)";
    }
}
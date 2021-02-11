<?php
declare(strict_types=1);

namespace Annotations\Annotations\Attributes;

use Annotations\Annotations\Annotation;

class DefaultAttribute extends Annotation
{
    /**
     * @inheritdoc
     */
    protected function validateType(string $type) : bool
    {
        return \strtolower($type) == "default";
    }

    /**
     * @inheritdoc
     */
    protected function validateParams($params) : bool
    {
        return is_array($params) && !empty($params);
    }

    public function __toString()
    {
        $params = array_map('strtolower', $this->params);
        $isFunction = false;

        $value = $params[0];
        unset($params[0]);

        if(!empty($params))
            $isFunction = \strtolower($params[1]) == "function";

        if($isFunction)
            return " default ($value)";
        
        return " default '$value'";
    }
}

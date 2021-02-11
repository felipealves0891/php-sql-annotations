<?php
declare(strict_types=1);

namespace Annotations\Annotations\Attributes;

use Annotations\Annotations\Annotation;

class FormAttribute extends Annotation
{
    /**
     * @inheritdoc
     */
    protected function validateType(string $type) : bool
    {
        return \strtolower($type) == "form";
    }

    /**
     * @inheritdoc
     */
    protected function validateParams($params) : bool
    {
        return is_array($params);
    }

    public function __toString()
    {
       
       $attrs = implode(' ', $this->params); 
       return "<input $attrs />";
    }
}

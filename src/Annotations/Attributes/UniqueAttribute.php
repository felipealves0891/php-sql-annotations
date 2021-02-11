<?php
declare(strict_types=1);

namespace Annotations\Annotations\Attributes;

use Annotations\Annotations\Annotation;

class UniqueAttribute extends Annotation 
{
    
    /**
     * @inheritdoc
     */
    protected function validateType(string $type) : bool
    {
        return strtolower($type) == 'unique';
    }

    /**
     * @inheritdoc
     */
    protected function validateParams($params) : bool
    {
        return \is_null($params);
    }

    public function __toString() 
    {
        return ' unique';
    }
}
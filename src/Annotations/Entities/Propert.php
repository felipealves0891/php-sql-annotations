<?php
declare(strict_types=1);

namespace Annotations\Annotations\Entities;

use Annotations\Annotations\Annotation;

class Propert extends Annotation
{
    /**
     * @inheritdoc
     */
    protected function validateType(string $type) : bool
    {
        return \is_string($type);
    }

    /**
     * @inheritdoc
     */
    protected function validateParams($params) : bool
    {
        $annotations = array_filter($params, fn($value) => ($value instanceof Annotation));
        return \count($annotations) == \count($params);
    }

    public function __toString()
    {
        $attrs = implode("", $this->params);
        return "[" . $this->type . "]" . $attrs;
    }

}
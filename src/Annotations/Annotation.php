<?php
declare(strict_types=1);

namespace Annotations\Annotations;

abstract class Annotation
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var array|string|null
     */
    protected $params;

    /**
     * @param string $type
     * @param mixed $params
     * @throws InvalidArgumentException
     */
    public function __construct(string $type, $params = null)
    {
        if(!$this->validateType($type))
            throw new \InvalidArgumentException("Tipo '$type' invalido para a respectiva classe!");

        if(!$this->validateParams($params))
            throw new \InvalidArgumentException("Parametros invalidos para o tipo '$type'!");

        $this->type = $type;
        $this->params = $params;
    }

    /**
     * validates if the type is what is expected by the concrete class
     * 
     * @param string $type
     * @return bool
     */
    protected abstract function validateType(string $type) : bool;

    /**
     * validate if the parameters are those expected by the type of the class
     * 
     * @param mixed $params
     * @return bool
     */
    protected abstract function validateParams($params) : bool;
}

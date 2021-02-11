<?php
declare(strict_types=1);

namespace Annotations\Engine;

class Engine
{
    /**
     * @var ReflectionClass
     */
    protected $replection;

    /**
     * @param ReflectionClass $replection
     */
    public function __construct(\ReflectionClass $replection)
    {
        $this->replection = $replection;
    }

    /**
     * @param string $classname
     * @return Engine
     * @throws \InvalidArgumentException
     */
    public static function Start(string $classname) : Engine
    {
        if(!class_exists($classname))
            throw new \InvalidArgumentException("Class $classname not found!");

        $rc = new \ReflectionClass($classname);
        return new self($rc);
    }

    /**
     * @return array
     */
    public function process() 
    {
        $comment = $this->replection->getDocComment();
        $classAnnotation = $this->readAnnotations($comment);

        $annotations = [];
        $annotations['class'] = $this->formattedAnnotations($classAnnotation); 

        $properties = $this->replection->getProperties();
        $annotations['class']['property'] = [];

        foreach ($properties as $key => $property) 
        {
            $comment = $property->getDocComment();
            $propertyAnnotation = $this->readAnnotations($comment);
            $name = $property->getName();
            $annotations['class']['property'][$name] 
                = $this->formattedAnnotations($propertyAnnotation); 
        }

        return $annotations;
    }

    private function readAnnotations(string $comment) : array
    {
        $commentSanitize = preg_replace('/[\r\n|*|\/|\s]/', '', $comment);
        $annotations = explode("@", $commentSanitize);
        $annotationsSanitize = array_filter($annotations, fn($value) => !empty($value));
        return $annotationsSanitize;
    }

    private function formattedAnnotations(array $annotations) : array
    {
        $formatted = [];
        foreach ($annotations as $key => $annotation) 
        {
            $formattedKey = substr($annotation, 0, strpos($annotation, "("));
            $formattedVal = substr($annotation, strpos($annotation, "'") + 1);
            $formattedVal = substr($formattedVal, 0, strlen($formattedVal)-2);

            if(strpos($formattedVal,',') != false)
                $formattedVal = explode("','", $formattedVal);

            $formatted[$formattedKey] = $formattedVal;
        }
        return $formatted;
    }


}
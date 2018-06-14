<?php

namespace Lle\BpmBundle\Action;

use Lle\BpmBundle\Action\ActionInterface;

abstract class AbstractAction implements ActionInterface
{
    private $parameters;

    public function supports($state)
    {
        return true;
    }

    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getParameter($key, $defaultValue = null){
        return $this->parameters[$key] ?? $defaultValue;
    }

    public static function getJsonSchema()
    {
        return "{}";
    }

    public static function getJsonDefault()
    {
        return "{}";
    }
}

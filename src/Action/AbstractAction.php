<?php

namespace Lle\BpmBundle\Trigger;

use Lle\BpmBundle\Action\ActionInterface;

abstract class AbstractTrigger implements ActionInterface
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

    public static function getJsonSchema()
    {
        return "{}";
    }
}

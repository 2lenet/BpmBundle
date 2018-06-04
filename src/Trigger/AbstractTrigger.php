<?php

namespace Lle\BpmBundle\Trigger;

use Lle\BpmBundle\Trigger\TriggerInterface;

abstract class AbstractTrigger implements TriggerInterface
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

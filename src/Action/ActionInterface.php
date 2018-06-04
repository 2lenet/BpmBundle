<?php

namespace Lle\BpmBundle\Action;

/**
 * Interface for Bpm Trigger
 */
interface ActionInterface
{
  public function execute(Object $object);
  public function setParameters(array $parameters);
  public function getJsonSchema();
}

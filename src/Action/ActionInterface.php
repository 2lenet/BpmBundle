<?php

namespace Lle\BpmBundle\Action;

/**
 * Interface for Bpm Trigger
 */
interface ActionInterface
{
  public function execute($object);
  public function getJsonSchema();
}

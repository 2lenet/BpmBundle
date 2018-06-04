<?php

namespace Lle\BpmBundle\Trigger;

/**
 * Interface for Bpm Trigger
 */
interface TriggerInterface
{
  public function support($object);
  public function getJsonSchema();
}

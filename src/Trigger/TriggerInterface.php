<?php

namespace Lle\BpmBundle\Trigger;

/**
 * Interface for Bpm Trigger
 */
interface TriggerInterface
{
  public function supports($state);
  public function setParameters(array $parameters);
  public function shouldExecute($object);
  public static function getJsonSchema();
}

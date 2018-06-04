<?php

namespace Lle\BpmBundle\Service;

use Lle\BpmBundle\TriggerRepository;

class TriggerExecutor {

  public function execute($trigger, $object)
  {
    $tclass = $trigger->getClassName();
    $concreteTrigger = new $tclass;
    $concreteTrigger->setParameters($trigger->getParameters());
    return $concreteTrigger->shouldExecute($object);
  }
}

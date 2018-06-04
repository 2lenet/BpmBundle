<?php

namespace Lle\BpmBundle\Trigger;

use Lle\BpmBundle\TriggerRepository;

class BpmExecutor {

  private $repo;
  public function __construct(TriggerRepository $repo)
  {
    $this->repo = $repo;
  }

  public function execute(Object $object)
  {
    foreach($repo->findAll() as $trigger) {
      $concreteTrigger = new $trigger->getClassName();
      $concreteTrigger->setParameters($trigger->getParameters());
      if ($concreteTrigger->shouldExecute($object)) {
        foreach($trigger->getActions() as $action) {
          $concreteAction = new $action->getClassName();
          $concreteAction->setParameters($action->getParameters());
          $concreteAction->execute();
        }
      }
    }
  }
}

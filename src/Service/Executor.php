<?php

namespace Lle\BpmBundle\Service;

use Lle\BpmBundle\TriggerRepository;
use Lle\BpmBundle\Service\TriggerExecutor;

class BpmExecutor {

  private $repo;
  public function __construct(TriggerRepository $repo)
  {
    $this->repo = $repo;
  }

  public function execute(Object $object)
  {
    $triggerExecutor = new TriggerExecutor();

    foreach($repo->findAll() as $trigger) {
      if ($triggerExecutor->shouldExecute($trigger, $object)) {
        foreach($trigger->getActions() as $action) {
          $concreteAction = new $action->getClassName();
          $concreteAction->setParameters($action->getParameters());
          $concreteAction->execute();
        }
      }
    }
  }
}

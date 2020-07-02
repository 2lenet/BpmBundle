<?php
namespace Lle\BpmBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Lle\BpmBundle\Entity\Trigger;
use Lle\BpmBundle\Service\Tag\ActionChain;
use Lle\BpmBundle\Service\Tag\TriggerChain;

class TriggerExecutor
{

    private $triggerChain;

    private $actionChain;

    private $triggerRepository;

    /**
     *
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(TriggerChain $triggerChain, ActionChain $actionChain, EntityManagerInterface $em)
    {
        $this->triggerRepository = $em->getRepository(Trigger::class);
        $this->triggerChain = $triggerChain;
        $this->actionChain = $actionChain;
        $this->em = $em;
    }

    public function executeAll()
    {
        foreach ($this->triggerRepository->findBy([
            'active' => true,
            'isAutomatic' => true
        ]) as $trigger) {
            $this->executeTriggerOnRepo($trigger);
        }
    }

    public function executeTriggerOnRepo($trigger)
    {
        if (!$trigger->getActive()) {
            return;
        }
        $i = 0;
        foreach ($this->em->getRepository($trigger->getEntityClass())
            ->findByEtat($trigger->getFrom()) as $object) {
            $this->executeTrigger($object, $trigger);
            if ($i ++ % 50 == 0) {
                $this->em->flush();
            }
        }
        $this->em->flush();
    }

    public function execute($object)
    {
        foreach ($this->triggerRepository->findBy([
            'active' => true
        ]) as $trigger) {
            $this->executeTrigger($object, $trigger);
        }
        $this->em->flush();
    }

    public function executeOne($object, $triggerCode)
    {
        $trigger = $this->triggerRepository->findOneBy([
            'code' => $triggerCode,
            'active' => true
        ]);
        if ($this->executeTrigger($object, $trigger)) {
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function executeTrigger($object, $trigger)
    {
        if (!$trigger->getActive()) {
            return;
        }
        $typeTrigger = $this->triggerChain->getTrigger($trigger->getClassName());
        $typeTrigger->setParameters($trigger->getParameters() ?? []);
        if ($object->getEtat() == $trigger->getFrom() && $typeTrigger->shouldExecute($object)) {
            foreach ($trigger->getActions() as $action) {
                if ($action->getActive()) {
                    /* @var \Lle\BpmBundle\Entity\Action $action */
                    $typeAction = $this->actionChain->getAction($action->getClassName());
                    $typeAction->setParameters($action->getParameters() ?? []);
                    $typeAction->execute($object);
                }
            }
            $object->setEtat($trigger->getTo());
            $object->setEtatUpdatedAt(new \Datetime());
            $this->em->persist($object);
            return true;
        }
        return false;
    }
}

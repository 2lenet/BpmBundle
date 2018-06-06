<?php
namespace Lle\BpmBundle\Service\Tag;

use Lle\BpmBundle\Trigger\TriggerInterface;

class TriggerChain
{
    private $triggers = [];

    public function __construct(iterable $triggers)
    {
        foreach($triggers as $trigger){
            $this->triggers[get_class($trigger)] = $trigger;
        }
    }

    public function addTrigger(TriggerInterface $trigger)
    {
        $this->triggers[get_class($trigger)] = $trigger;
    }

    public function getTriggers():iterable{
        return $this->triggers;
    }

    public function getTrigger(string $className): TriggerInterface{
        return $this->triggers[$className];
    }
}
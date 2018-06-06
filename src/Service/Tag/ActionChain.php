<?php
namespace Lle\BpmBundle\Service\Tag;

use Lle\BpmBundle\Action\ActionInterface;

class ActionChain
{
    private $actions = [];

    public function __construct(iterable $actions)
    {
        foreach($actions as $action){
            $this->actions[get_class($action)] = $action;
        }
    }

    public function addTrigger(ActionInterface $action)
    {
        $this->actions[get_class($action)] = $action;
    }

    public function getActions():iterable{
        return $this->actions;
    }

    public function getAction(string $className): ActionInterface{
        return $this->actions[$className];
    }
}
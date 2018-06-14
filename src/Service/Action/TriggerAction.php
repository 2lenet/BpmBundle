<?php
declare(strict_types=1);

namespace Lle\BpmBundle\Service\Action;
use Lle\BpmBundle\Service\Tag\TriggerChain;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class TriggerAction
{


    private $triggerChain;

    public function __construct(TriggerChain $triggerChain){
        $this->triggerChain = $triggerChain;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $trigger = $this->triggerChain->getTrigger($request->request->get('class_name'));
        return new JsonResponse(['schema'=> json_decode($trigger->getJsonSchema()), 'default'=> json_decode($trigger->getJsonDefault())]);
    }
}
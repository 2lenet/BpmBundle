<?php
declare(strict_types=1);

namespace Lle\BpmBundle\Service\Action;
use Lle\BpmBundle\Service\Tag\ActionChain;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ActionAction
{

    private $actionChain;

    public function __construct(ActionChain $actionChain){
        $this->actionChain = $actionChain;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $action = $this->actionChain->getAction($request->request->get('class_name'));
        return new JsonResponse(['schema'=> json_decode($action->getJsonSchema()), 'default'=> json_decode($action->getJsonDefault())]);
    }
}
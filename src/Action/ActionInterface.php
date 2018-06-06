<?php

namespace Lle\BpmBundle\Action;

/**
 * Interface for Bpm Trigger
 */
interface ActionInterface
{
    public function execute($object);
    public function setParameters(array $parameters);
    public static function getJsonSchema();
    public static function getName();
}

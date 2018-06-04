<?php

namespace Lle\BpmBundle\Tests;

use Lle\BpmBundle\Entity\Trigger;
use Lle\BpmBundle\Trigger\AbstractTrigger;
use Lle\BpmBundle\Action\ActionInterface;
use Lle\BpmBundle\Service\TriggerExecutor;

use PHPUnit\Framework\TestCase;

class TriggerTest extends TestCase
{

    public function testTrigger()
    {
        $trigger = new Trigger();
	      $trigger->setClassName(TestTrigger::class);
	      $trigger->setParameters(json_decode('{"status":"foo"}', true));
        $executor = new TriggerExecutor();
        $obj = new \StdClass();
        $this->assertTrue($executor->execute($trigger, $obj));
        $this->assertFalse($executor->execute($trigger, null));
    }
}

class TestTrigger extends AbstractTrigger
{
  public function shouldExecute($object) {
    if ($object === null) return false;
    else return true;
  }
}

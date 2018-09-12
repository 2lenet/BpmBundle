<?php

namespace Lle\BpmBundle\Command;


use Doctrine\ORM\EntityManagerInterface;
use Lle\BpmBundle\Service\TriggerExecutor;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Command\Command;

final class BpmExecuteCommand extends Command
{
    private $em = null;
    private $executor = null;

    public function __construct(EntityManagerInterface $em, TriggerExecutor $executor)
    {
        $this->em = $em;
        $this->executor = $executor;
        parent::__construct('bpm:execute');
    }

    protected function configure()
    {
        $this
            ->setDescription('Execute trigger')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $this->executor->executeAll();
        $io->success('Success');
    }
}

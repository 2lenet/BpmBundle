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

        foreach($this->em->getMetadataFactory()->getAllMetadata() as $metaDataEntity){
            /* @var \Doctrine\ORM\Mapping\ClassMetadata $metaDataEntity */
            $io->note('Looking trigger for' . $metaDataEntity->getName());
            if(!$metaDataEntity->getReflectionClass()->isAbstract()) {
                //TODO you can use an annotation or interface for pass only the entity annot or implements
                //TODO findAll is too big request
                foreach ($this->em->getRepository($metaDataEntity->getName())->findAll() as $object) {
                    $this->executor->execute($object);
                }
            }
        }


        $io->success('Success');
    }
}

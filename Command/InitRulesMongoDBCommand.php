<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitRulesMongoDBCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('init:rules:mongodb')
            ->setDescription('Sets up collections and indexes for the rules engine');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $mongo = $container->get('doctrine_mongodb.odm.default_connection');
        $this->dbName = $container->getParameter('doctrine_mongodb.odm.rules.database');
        $db = $mongo->selectDatabase($this->dbName);

        $entryCollection = $db->selectCollection($container->getParameter('doctrine_mongodb.odm.rules.collection'));
        //$entryCollection->ensureIndex(array('objectIdentity.$id' => 1));

        $output->writeln('Rule indexes have been initialized successfully.');

    }
}
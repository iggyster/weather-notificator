<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Notify extends Command
{
    /**
     * @var string|null The default command name
     */
    protected static $defaultName = 'notify';

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setDescription('Send notification');
        $this->addArgument('type', InputArgument::REQUIRED, '', 'sms');
        $this->addArgument('to', InputArgument::REQUIRED, '', null);
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');
        $to = $input->getArgument('to');

        $strategy = NotificationStrategyFactory::create($type);
        $strategy->notify($to);
    }
}
<?php

declare(strict_types=1);

namespace App\Command;

use App\Factory\MessageFactory;
use App\Factory\NotificationStrategyFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
        $this->addArgument('type', InputArgument::REQUIRED, 'Set the notification type that you want ot send: sms');
        $this->addArgument('to', InputArgument::REQUIRED, 'Define receiver address according to the type: phone number (for sms)');
        $this->addOption('country', 'c', InputOption::VALUE_OPTIONAL, 'A country for which the weather data should be fetched', 'Thessaloniki');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');
        $to = $input->getArgument('to');
        $country = $input->getOption('country');

        $this->log('Try to send '.$type.' notification to the '.$to);

        $factory = NotificationStrategyFactory::create();
        $strategy = $factory->createStrategy($type);

        $factory = MessageFactory::create();
        $message = $factory->createMessageForCountry($country);

        $message->setSender('Weather');
        $message->setReceiver($to);
        $strategy->notify($message);

        $this->log('Notification sent successfully');

        return 1;
    }

    /**
     * @param string $message
     */
    private function log(string $message): void
    {
        $path = __DIR__ . '/../../var/log/notifications.log';

        file_put_contents($path, date('Y-m-d H:i:s').' '.$message.PHP_EOL, FILE_APPEND);
    }
}
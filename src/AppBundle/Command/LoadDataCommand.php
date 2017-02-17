<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;

class LoadDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('db:seed')
            ->setDescription('Load data into database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start = microtime(true);
        $buffer = new BufferedOutput();

        $progress = new ProgressBar($output, 5);
        $progress->setFormatDefinition('custom', ' %current%/%max% -- %message%');
        $progress->setFormat('custom');
        $progress->start();

        foreach ($this->getCommands() as $data) {
            $progress->setMessage($data['message']);
            $command = $this->getApplication()->find($data['command']);
            $code = $command->run(new ArrayInput($data['args']), $buffer);
            if ($code !== 0) {
                $output->writeln(['', ' [!] Got an error ! See output below:', '']);
                $output->write($buffer->fetch());
                return 1;
            }
            $progress->advance();
        }

        $progress->setMessage(sprintf('Done in %.3fs!', microtime(true) - $start));
        $progress->finish();
        $output->writeln('');

        return 0;
    }

    private function getCommands()
    {
        return [
            [
                'message' => 'Dropping database',
                'command' => 'doctrine:database:drop',
                'args' => ['--if-exists' => true, '--force' => true],
            ],
            [
                'message' => 'Creating database',
                'command' => 'doctrine:database:create',
                'args' => [],
            ],
            [
                'message' => 'Importing schema',
                'command' => 'doctrine:schema:update',
                'args' => ['--force' => true],
            ],
            [
                'message' => 'Loading fixtures',
                'command' => 'doctrine:fixtures:load',
                'args' => ['--append' => true],
            ],
        ];
    }
}

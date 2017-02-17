<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 * Class CodeTestCommand
 * @package AppBundle\Command
 */
class CodeTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('code:test')
            ->setAliases(['code:tests', 'code:phpunit'])
            ->setDescription('Run PHPUnit tests.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $root = realpath($this->getContainer()->getParameter('kernel.root_dir').'/..');
        $phpunit = $root.'/vendor/phpunit/phpunit/phpunit';
        $src = $root.'/src';

        $process = new Process($phpunit.' '.$src);
        $process->setTty(true);

        return $process->run();
    }
}

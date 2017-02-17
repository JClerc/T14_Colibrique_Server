<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 * Class CodeLintCommand
 * @package AppBundle\Command
 */
class CodeLintCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('code:lint')
            ->setAliases(['code:linter', 'code:phpcs'])
            ->setDescription('Lint code in src/ using Symfony2 standard.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $root = realpath($this->getContainer()->getParameter('kernel.root_dir').'/..');
        $phpcs = $root.'/vendor/bin/phpcs';
        $args = '--standard='.$root.'/vendor/escapestudios/symfony2-coding-standard/Symfony2';
        $src = $root.'/src';

        $process = new Process($phpcs.' '.$args.' '.$src);
        $process->setTty(true);
        $code = $process->run();
        if ($code === 0) {
            $output->writeln('Code is correct!');
        }

        return $code;
    }
}

<?php
namespace Bp\CodeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PathCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('code:resource:path')
            ->setDescription('Returns the resource path for template logical name')
            ->addArgument('lookup', InputArgument::REQUIRED, 'What template are you looking for?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // gather arguments and options
        $lookup = $input->getArgument('lookup');

        // gather services
        $container = $this->getContainer();
        $controller = $container->get('bp.code.helpers');

        // perform resource lookup
        $resource_path = $controller->resourcePathAction($lookup);

        $output->writeln($resource_path);
    }
}
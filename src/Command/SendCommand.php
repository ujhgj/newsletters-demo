<?php

namespace App\Command;

use App\Entity\Newsletter;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SendCommand extends Command
{
    protected static $defaultName = 'send';

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct();
    }

    protected function configure()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Registry $doctrine */
        $doctrine = $this->container->get('doctrine');

        // prevent memory leaking
        $doctrine->getConnection()->getConfiguration()->setSQLLogger(null);

        $m = $doctrine->getManager();

        while (true) {
            //$output->writeln(memory_get_usage());

            /** @var Newsletter[] $newsletters */
            $newsletters = $doctrine
                ->getRepository(\App\Entity\Newsletter::class)->findAll();

            foreach ($newsletters as $newsletter) {
                if ($newsletter->getPending() > 0) {
                    $newsletter->setPending(
                        $newsletter->getPending() - 1
                    );
                    $m->persist($newsletter);
                    $m->flush($newsletter);
                }
            }

            $m->clear();
            usleep(500);
        }
    }
}

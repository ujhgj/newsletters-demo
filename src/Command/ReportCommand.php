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

class ReportCommand extends Command
{
    protected static $defaultName = 'report';

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

        /** @var Newsletter[] $newsletters */
        $newsletters = $doctrine
            ->getRepository(\App\Entity\Newsletter::class)->findAll();

        foreach ($newsletters as $newsletter) {
            if ($newsletter->getPending() === 0 && (is_null($newsletter->getFail()) || is_null($newsletter->getSuccess()))) {
                $failed = random_int(0, 10);
                $success = $newsletter->getOverall() - $failed;
                $newsletter
                    ->setSuccess($success)
                    ->setFail($failed);
                $m->persist($newsletter);
                $m->flush($newsletter);
            }
        }
    }
}

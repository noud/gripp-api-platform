<?php

namespace App\Command;

use App\Service\ContactService;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ContactCommand extends AbstractCommand
{
    /**
     * @var ContactService
     */
    private $contactService;

    public function __construct(
        ContactService $contactService
    ) {
        $this->contactService = $contactService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:contact')
            ->setDescription('Contact.')
            ->setHelp('This command works Contacts.')
            ->addArgument('action', InputArgument::OPTIONAL, 'Action')
            ->addArgument('id', InputArgument::OPTIONAL, 'Id')
        ;
    }

    /**
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $action = $input->getArgument('action');
        $this->executeStart($output);
        switch ($action) {
            case 'update':
            default:
                $this->updateAll($output);
                break;
        }
        $this->executeStop($output);
    }

    private function updateAll(OutputInterface $output): void
    {
        $this->contactService->updateAll();
    }
}

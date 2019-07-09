<?php

namespace App\Command\Gripp;

use App\Command\AbstractCommand;
use App\Gripp\Service\TagService;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TagCommand extends AbstractCommand
{
    /**
     * @var TagService
     */
    private $tagService;

    public function __construct(
        TagService $tagService
    ) {
        $this->tagService = $tagService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('gripp:tag')
            ->setDescription('Tag of the Gripp API.')
            ->setHelp('This command shows Tags of the Gripp API.')
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
            case 'view':
                /** @var int $id */
                $id = $input->getArgument('id') ?: 1;
                $this->view($output, $id);
                break;
            case 'index':
            default:
                $this->index($output);
                break;
        }
        $this->executeStop($output);
    }

    private function index(OutputInterface $output): void
    {
        $tagsName = 'Tags';
        $tagsArray = $this->tagService->allTags();
        $this->entitiesTable($output, $tagsName, $tagsArray);
    }

    private function view(OutputInterface $output, int $id): void
    {
        $tagName = 'Tag';
        $tagArray = $this->tagService->getTagByIdAsArray($id);
        $this->entityView($output, $tagName, $tagArray);
    }
}

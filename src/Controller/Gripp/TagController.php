<?php

namespace App\Controller\Gripp;

use App\Controller\AbstractController;
use App\Gripp\Service\TagService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/tag")
 */
class TagController extends AbstractController
{
    /**
     * @var TagService
     */
    private $tagService;

    public function __construct(
        string $environment,
        TagService $tagService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->tagService = $tagService;
    }

    /**
     * @Route("/index", name="gripp_tag_index")
     */
    public function index(): Response
    {
        $tagsName = 'Tags';
        //$tagsArray = $this->tagService->allTags();
        $tagsArray = [
            [
                'id' => 1,
                'name' => 'tag name 1',
            ],
            [
                'id' => 2,
                'name' => 'tag name 2',
            ],
        ];

        return $this->entitiesTable($tagsName, $tagsArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_tag_view")
     */
    public function view(int $id): Response
    {
        $tagName = 'Tag';
        //$tagArray = $this->tagService->getTagById($id);
        $tagArray = [
            'id' => $id,
            'name' => 'tag name '.$id,
        ];

        return $this->entityView($tagName, $tagArray);
    }
}

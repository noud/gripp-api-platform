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
        $tagsArray = $this->tagService->allTags();

        return $this->entitiesTable($tagsName, $tagsArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_tag_view")
     */
    public function view(int $id): Response
    {
        $tagName = 'Tag';
        $tagArray = $this->tagService->getTagById($id);

        return $this->entityView($tagName, $tagArray);
    }
}

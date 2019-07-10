<?php

namespace App\Controller\Gripp;

use App\Controller\AbstractController;
use App\Gripp\Form\Data\TagData;
use App\Gripp\Form\Handler\TagHandler;
use App\Gripp\Form\Type\TagType;
use App\Gripp\Service\TagService;
use Symfony\Component\HttpFoundation\Request;
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
        $tagArray = $this->tagService->getTagByIdAsArray($id);

        return $this->entityView($tagName, $tagArray);
    }
    
    /**
     * @Route("/edit/{id}", name="gripp_tag_edit")
     */
    public function edit(int $id, TagHandler $tagHandler, Request $request): Response
    {
        $tag = $this->tagService->getTagById($id);
        $data = new TagData($tag);
        $form = $this->createForm(TagType::class, $data);
        
        if ($tagHandler->handleRequest($form, $request, $tag)) {
            $this->addFlash('success', 'tag.message.updated');
            
            return $this->redirectToRoute('gripp_tag_index');
        }
        
        return $this->render('gripp/tag/add_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/add", name="gripp_tag_add")
     */
    public function create(TagHandler $tagHandler, Request $request): Response
    {
        $data = new TagData();
        $form = $this->createForm(TagType::class, $data);
        
        if ($tagHandler->handleRequest($form, $request)) {
            $this->addFlash('success', 'tag.message.added');
            
            return $this->redirectToRoute('gripp_tag_index');
        }
        
        return $this->render('gripp/tag/add_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/delete/{id}", name="gripp_tag_delete")
     */
    public function delete(int $id, Request $request): Response
    {
        $tag = $this->tagService->getTagById($id);
        if ($tag) {
            $this->tagService->deleteTag($tag);
        }
        
        return $this->redirectToRoute('gripp_tag_index');
    }
}

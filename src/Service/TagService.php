<?php

namespace App\Service;

use App\Entity\Tag;
use App\Form\Data\TagData;
use App\Repository\TagRepository;

class TagService extends AbstractService
{
    /**
     * @var TagRepository
     */
    private $tagRepository;
    
    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService,
        TagRepository $tagRepository
    ) {
        parent::__construct($cacheService,$apiService,$sqlService);
        $this->tagRepository = $tagRepository;
    }

    public function deleteTag(Tag $tag): void
    {
        $id = $tag->getId();
        $this->delete($id);
    }

    /*
        public function addTag(TagData $tagData)
        {
            $tag = new Tag();
            $tag->setContent($tagData->content);

            $this->createTag($tag);
        }
    */
    
    public function createTag(TagData $tagData): void
    {
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($tagData, null); //, ['groups' => 'write']);
        $this->create($fields);
    }

    public function updateTagWithData(Tag $tag, TagData $tagData): void
    {
        $id = $tag->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($tagData, null); //, ['groups' => 'write']);
        $this->update($id, $fields);
    }
    
    public function updateTag(Tag $tag): void
    {
        $id = $tag->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($tag, null); //, ['groups' => 'write']);
        unset($fields['id']);
        unset($fields['createdon']);
        unset($fields['updatedon']);
        unset($fields['searchname']);
        $this->update($id, $fields);
    }
    
    private function create(array $fields): bool
    {
        $this->invalidateAllCache();
        
        $response = $this->apiService->API->tag_create($fields);
        if (isset($response[0]['result']['success']) && $response[0]['result']['success']) {
            return true;
        } else {
            return false;
        }
    }

    private function delete(int $id): bool
    {
        $this->invalidateCache($id);
        $this->invalidateAllCache();
        
        $response = $this->apiService->API->tag_delete($id);
        if (isset($response[0]['result']['success']) && $response[0]['result']['success']) {
            return true;
        } else {
            return false;
        }
    }

    private function update(int $id, array $fields): bool
    {
        //$entityName = str_replace('Service', '', $this->name());
        //$entityFunction = $this->entityName.'_update';

        $this->invalidateCache($id);
        $this->invalidateAllCache();
        
        //$response = $this->API->$entityFunction($id, $fields);
        $response = $this->apiService->API->tag_update($id, $fields);
        if (isset($response[0]['result']['success']) && $response[0]['result']['success']) {
            return true;
        } else {
            return false;
        }
    }
}

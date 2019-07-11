<?php

namespace App\Service;

use App\Entity\Tag;
use App\Enum\API\FiltersOperatorEnum;
use App\Enum\API\OptionsOrderingsDirectionEnum;
use App\Form\Data\TagData;
use App\Repository\TagRepository;
use App\Service\CacheService;

class TagService
{
    /**
     * @var CacheService
     */
    private $cacheService;

    /**
     * @var APIService
     */
    private $apiService;
    
    /**
     * @var SQLService
     */
    private $sqlService;
    
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
        $this->cacheService = $cacheService;
        $this->apiService = $apiService;
        $this->sqlService = $sqlService;
        $this->tagRepository = $tagRepository;
    }

    public function allTags(): array
    {
        //$this->invalidateAllCache();
        $cacheKey = sprintf('gripp_tags_%s', md5('tags'));
        $hit = $this->cacheService->getFromCache($cacheKey);
        if (false === $hit) {
            $this->sqlService->truncate('App\Entity\Tag');
            
            $from = 0;
            $limit = 10;
            $totalResponse = [];

            do {
                $options = [
                    'paging' => [
                        'firstresult' => $from,
                        'maxresults' => $limit,
                    ],
                    'orderings' => [
                        [
                            'field' => 'tag.id',
                            'direction' => OptionsOrderingsDirectionEnum::ASC,
                        ],
                    ],
                ];
                $response = $this->get([], $options);
                if (\count($response['rows'])) {
                    $totalResponse = array_merge($totalResponse, $response['rows']);
                    $from = $response['next_start'];
                } else {
                    // @TODO some real bad did happen?
                    break;
                }
            } while ($response['more_items_in_collection']);

            $this->cacheService->saveToCache($cacheKey, $totalResponse);
            
            foreach ($totalResponse as $response) {
                $this->saveToCache($response);
                $tag = $this->denormalizeArrayToTag($response);
                $this->tagRepository->add($tag);
            }
            $this->sqlService->getEntityManager()->flush();
            
            return $totalResponse;
        }

        return $hit;
    }

    public function getTagByIdAsArray(int $id): ?array
    {
        $filters = [
            [
                'field' => Tag::API_NAME.'.id',
                'operator' => FiltersOperatorEnum::EQUALS,
                'value' => $id,
            ],
        ];
        $response = $this->getone($filters, [], $id);

        return $response;
    }
    
    public function denormalizeArrayToTag(array $data): ?Tag
    {
        $data = array_filter($data, function($var){return !is_null($var);});
        $tagCreatedon = $this->apiService->dateTimeSerializer->denormalize($data['createdon'], \DateTime::class);
        unset($data['createdon']);
        if (isset($data['updatedon'])) {
            $tagUpdatedon = $this->apiService->dateTimeSerializer->denormalize($data['updatedon'], \DateTime::class);
            unset($data['updatedon']);
        }
        $tag = $this->apiService->serializer->denormalize($data, Tag::class);
        $tag->setCreatedon($tagCreatedon);
        if (isset($tagUpdatedon)) {
            $tag->setUpdatedon($tagUpdatedon);
        }
        
        return $tag;
    }
    
    public function getTagById(int $id): ?Tag
    {
        $response = $this->getTagByIdAsArray($id);
        if ($response) {
            return $this->denormalizeArrayToTag($response);
        }
        return null;
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

    private function get(array $filters = [], array $options = []): array
    {
        $filters = [
            [
                'field' => Tag::API_NAME.'.id',
                'operator' => FiltersOperatorEnum::GREATEREQUALS,
                'value' => 1,
            ],
        ];

        $batchresponse = $this->apiService->API->tag_get($filters, $options);
        $response = $batchresponse[0]['result'];

        return $response;
    }

    private function getone(array $filters = [], array $options = [], int $id = 1): ?array
    {
        $filters = [
            [
                'field' => Tag::API_NAME.'.id',
                'operator' => FiltersOperatorEnum::EQUALS,
                'value' => $id,
            ],
        ];

        $response = $this->apiService->API->tag_getone($filters, $options);
        if ($response[0]['result']['count'] === 1) {
            return $response[0]['result']['rows'][0];
        }

        return null;
    }

    private function invalidateAllCache():  void
    {
        $cacheKey = sprintf('gripp_tags_%s', md5('tags'));
        $this->cacheService->deleteCacheByKey($cacheKey);
    }
    
    private function invalidateCache(int $id): void
    {
        $cacheKey = sprintf('gripp_'.Tag::API_NAME.'_%s', md5((string) $id));
//        $cacheKey = sprintf('gripp_'.$entityName::API_NAME.'_%s', md5((string) $id));
        $this->cacheService->deleteCacheByKey($cacheKey);
    }

    
    private function saveToCache(array $response): void
    {
        $cacheKey = sprintf('gripp_'.Tag::API_NAME.'_%s', md5((string) $response['id']));
        $this->cacheService->saveToCache($cacheKey, $response);
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

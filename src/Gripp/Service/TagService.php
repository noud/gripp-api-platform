<?php

namespace App\Gripp\Service;

use App\Gripp\Entity\Tag;
use App\Gripp\Enum\API\FiltersOperatorEnum;
use App\Gripp\Enum\API\OptionsOrderingsDirectionEnum;
use App\Gripp\Form\Data\TagData;
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
    
    public function __construct(
        CacheService $cacheService,
        APIService $apiService
    ) {
        $this->cacheService = $cacheService;
        $this->apiService = $apiService;
    }

    public function allTags(): array
    {
        $cacheKey = sprintf('gripp_tags_%s', md5('tags'));
        $hit = $this->cacheService->getFromCache($cacheKey);
        if (false === $hit) {
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
    
    public function getTagById(int $id): ?Tag
    {
        $response = $this->getTagByIdAsArray($id);
        if ($response) {
            $response = array_filter($response, function($var){return !is_null($var);} );
            $tag = $this->apiService->serializer->denormalize($response, Tag::class);
            return $tag;
        }
        return null;
    }
    
    public function deleteTag(Tag $tag): void
    {
        $id = $tag->getId();
        $this->delete($id);
    }

    /*
        public function addTag(TagAddData $tagData)
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

    public function updateTag(Tag $tag, TagData $tagData): void
    {
        $id = $tag->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($tagData, null); //, ['groups' => 'write']);
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

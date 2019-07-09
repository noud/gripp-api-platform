<?php

namespace App\Gripp\Service;

use App\Gripp\Entity\Tag;
use App\Gripp\Enum\API\FiltersOperatorEnum;
use App\Gripp\Enum\API\OptionsOrderingsDirectionEnum;
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

    public function getTagById(int $id): array
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

    public function deleteTag(Tag $tag): array
    {
        $id = $tag->getId();

        return $this->delete($id);
    }

    /*
        public function addTag(TagAddData $tagData)
        {
            $tag = new Tag();
            $tag->setContent($tagData->content);

            $this->createTag($tag);
        }
    */
    public function createTag(Tag $tag): array
    {
        /** @var array $fields */
        $fields = $this->serializer->normalize($tag, null, ['groups' => 'write']);
        $this->create($fields);
    }

    public function updateTag(Tag $tag): array
    {
        $id = $tag->getId();
        /** @var array $fields */
        $fields = $this->serializer->normalize($tag, null, ['groups' => 'write']);
        $this->update($id, $fields);
    }

    private function create(array $fields): array
    {
        $cacheKey = sprintf('gripp_'.Tag::API_NAME.'s_%s', md5(Tag::API_NAME.'s'));
        $this->cacheService->deleteCacheByKey($cacheKey);

        $response = $this->apiService->API->tag_create($fields);

        return $response;
    }

    private function delete(int $id): array
    {
        $cacheKey = sprintf('gripp_'.Tag::API_NAME.'_%s', md5((string) $id));
        $this->cacheService->deleteCacheByKey($cacheKey);

        $batchresponse = $this->apiService->API->tag_delete($id);
        $response = $batchresponse[0]['result'];

        return $response;
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

    private function getone(array $filters = [], array $options = [], int $id = 1): array
    {
        $filters = [
            [
                'field' => Tag::API_NAME.'.id',
                'operator' => FiltersOperatorEnum::EQUALS,
                'value' => $id,
            ],
        ];

        $batchresponse = $this->apiService->API->tag_getone($filters, $options);
        $response = $batchresponse[0]['result']['rows'][0];

        return $response;
    }

    private function update(int $id, array $fields): array
    {
        //$entityName = str_replace('Service', '', $this->name());
        //$entityFunction = $this->entityName.'_update';

        $cacheKey = sprintf('gripp_'.Tag::API_NAME.'_%s', md5((string) $id));
//        $cacheKey = sprintf('gripp_'.$entityName::API_NAME.'_%s', md5((string) $id));
        $this->cacheService->deleteCacheByKey($cacheKey);

        //$response = $this->API->$entityFunction($id, $fields);
        $response = $this->apiService->API->tag_update($id, $fields);

        return $response;
    }
}

<?php

namespace App\Service;

use App\Enum\API\FiltersOperatorEnum;
use App\Enum\API\OptionsOrderingsDirectionEnum;
use App\Service\CacheService;

abstract class AbstractService
{
    /**
     * @var CacheService
     */
    protected $cacheService;
    
    /**
     * @var APIService
     */
    protected $apiService;
    
    /**
     * @var SQLService
     */
    protected $sqlService;
    
    /**
     * @var string
     */
    protected $lowercaseClassName;
    
    /**
     * @var string
     */
    protected $className;
    
    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService
    ) {
        $this->cacheService = $cacheService;
        $this->apiService = $apiService;
        $this->sqlService = $sqlService;
        $this->lowercaseClassName = $this->getLowercaseClassName();
        $this->className = $this->getClassName();
    }
    
    protected function getClassName(): string
    {
        $fullClassName = get_class($this);
        $fullClassNameParts = explode('\\', $fullClassName);
        return str_replace('Service', '', end($fullClassNameParts));
    }
    
    protected function getLowercaseClassName(): string
    {
        return strtolower($this->getClassName());
    }

    public function getAll(): array
    {
        $entityName = "App\Entity\\".$this->className;
        
        //$this->invalidateAllCache();
        $hit = $this->getAllCache();
        if (false === $hit) {
            $this->sqlService->truncate("App\Entity\\".$this->className);

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
                            'field' => $entityName::API_NAME.'.id',
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

            $this->saveAllToCache($totalResponse);
            
            $entityManager = $this->sqlService->getEntityManager();
            $repository = $entityManager->getRepository("App\Entity\\".$this->className);
            foreach ($totalResponse as $response) {
                $this->saveToCache($response);
                $entity = $this->denormalizeArrayToEntity($response);
                $repository->add($entity);
            }
            $repository->flush();
            return $totalResponse;
        }
        
        return $hit;
    }
    
    public function getEntityByIdAsArray(int $id): ?array
    {
        $filters = [
            [
                'field' => $this->lowercaseClassName.'.id',
                'operator' => FiltersOperatorEnum::EQUALS,
                'value' => $id,
            ],
        ];
        $response = $this->getone($filters, [], $id);
        
        return $response;
    }
    
    /**
     * @return object
     */
    public function denormalizeArrayToEntity(array $data)
    {
        $data = array_filter($data, function($var){return !is_null($var);});
        $createdon = $this->apiService->dateTimeSerializer->denormalize($data['createdon'], \DateTime::class);
        unset($data['createdon']);
        if (isset($data['updatedon'])) {
            $updatedon = $this->apiService->dateTimeSerializer->denormalize($data['updatedon'], \DateTime::class);
            unset($data['updatedon']);
        }
        $entity = $this->apiService->serializer->denormalize($data, "App\Entity\\".$this->className);
        $entity->setCreatedon($createdon);
        if (isset($updatedon)) {
            $entity->setUpdatedon($updatedon);
        }
        
        return $entity;
    }
    
    /**
     * @return object|null
     */
    public function getEntityById(int $id)
    {
        $response = $this->getEntityByIdAsArray($id);
        if ($response) {
            return $this->denormalizeArrayToEntity($response);
        }
        return null;
    }
    
    private function get(array $filters = [], array $options = []): array
    {
        $entityName = "App\Entity\\".$this->className;
        $filters = [
            [
                'field' => $entityName::API_NAME.'.id',
                'operator' => FiltersOperatorEnum::GREATEREQUALS,
                'value' => 1,
            ],
        ];
        
        $methodName = $entityName::API_NAME.'_get';
        $batchresponse = $this->apiService->API->$methodName($filters, $options);
        $response = $batchresponse[0]['result'];
        
        return $response;
    }
    
    private function getone(array $filters = [], array $options = [], int $id = 1): ?array
    {
        $filters = [
            [
                'field' => $this->lowercaseClassName.'.id',
                'operator' => FiltersOperatorEnum::EQUALS,
                'value' => $id,
            ],
        ];
        
        $entityName = "App\Entity\\".$this->className;
        $methodName = $entityName::API_NAME.'_getone';
        $response = $this->apiService->API->$methodName($filters, $options);
        if ($response[0]['result']['count'] === 1) {
            return $response[0]['result']['rows'][0];
        }
        
        return null;
    }
    
    private function getAllCacheKey(): string
    {
        return sprintf('gripp_'.$this->lowercaseClassName.'_%s', md5($this->lowercaseClassName));
    }
    
    private function getCacheKey(int $id): string
    {
        return sprintf('gripp_'.$this->lowercaseClassName.'_%s', md5((string) $id));
    }
    
    /**
     * @return mixed|bool
     */
    private function getAllCache()
    {
        return $this->cacheService->getFromCache($this->getAllCacheKey());
    }
    
    private function saveAllToCache(array $response): void
    {
        $this->cacheService->saveToCache($this->getAllCacheKey(), $response);
    }
    
    public function invalidateAllCache(): void
    {
        $this->cacheService->deleteCacheByKey($this->getAllCacheKey());
    }
    
    private function saveToCache(array $response): void
    {
        $this->cacheService->saveToCache($this->getCacheKey($response['id']), $response);
    }
    
    public function invalidateCache(int $id): void
    {
        $this->cacheService->deleteCacheByKey($this->getCacheKey($id));
    }
}

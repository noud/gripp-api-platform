<?php

namespace App\Service;

use App\Entity\Taaktype;
use App\Enum\API\FiltersOperatorEnum;
use App\Enum\API\OptionsOrderingsDirectionEnum;
use App\Repository\TaaktypeRepository;
use App\Service\CacheService;

class TaaktypeService extends AbstractService
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
     * @var TaaktypeRepository
     */
    private $taaktypeRepository;
    
    /**
     * @var string
     */
    private $lowercaseClassName;

    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService,
        TaaktypeRepository $taaktypeRepository
    ) {
        $this->cacheService = $cacheService;
        $this->apiService = $apiService;
        $this->sqlService = $sqlService;
        $this->taaktypeRepository = $taaktypeRepository;
        $this->lowercaseClassName = $this->getLowercaseClassName();
    }

    public function allTaaktypes(): array
    {
        //$this->invalidateAllCache();
        $className = $this->getClassName();
        $cacheKey = sprintf('gripp_'.$this->lowercaseClassName.'_%s', md5($this->lowercaseClassName));
        $hit = $this->cacheService->getFromCache($cacheKey);
        if (false === $hit) {
            $this->sqlService->truncate('App\Entity\\'.$className);
            
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
                            'field' => $this->lowercaseClassName.'.id',
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
                $taaktype = $this->denormalizeArrayToTaaktype($response);
                $this->taaktypeRepository->add($taaktype);
            }
            $this->sqlService->getEntityManager()->flush();
            
            return $totalResponse;
        }

        return $hit;
    }

    public function getTaaktypeByIdAsArray(int $id): ?array
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
    
    public function denormalizeArrayToTaaktype(array $data): ?Taaktype
    {
        $data = array_filter($data, function($var){return !is_null($var);});
        $taaktypeCreatedon = $this->apiService->dateTimeSerializer->denormalize($data['createdon'], \DateTime::class);
        unset($data['createdon']);
        if (isset($data['updatedon'])) {
            $taaktypeUpdatedon = $this->apiService->dateTimeSerializer->denormalize($data['updatedon'], \DateTime::class);
            unset($data['updatedon']);
        }
        $taaktype = $this->apiService->serializer->denormalize($data, Taaktype::class);
        $taaktype->setCreatedon($taaktypeCreatedon);
        if (isset($taaktypeUpdatedon)) {
            $taaktype->setUpdatedon($taaktypeUpdatedon);
        }
        
        return $taaktype;
    }
    
    public function getTaaktypeById(int $id): ?Taaktype
    {
        $response = $this->getTaaktypeByIdAsArray($id);
        if ($response) {
            return $this->denormalizeArrayToTaaktype($response);
        }
        return null;
    }
    
    public function deleteTaaktype(Taaktype $taaktype): void
    {
        $id = $taaktype->getId();
        $this->delete($id);
    }
    
    public function updateTaaktype(Taaktype $taaktype): void
    {
        $id = $taaktype->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($taaktype, null); //, ['groups' => 'write']);
        unset($fields['id']);
        unset($fields['createdon']);
        unset($fields['updatedon']);
        unset($fields['searchname']);
        $this->update($id, $fields);
    }
    
    private function create(array $fields): bool
    {
        $this->invalidateAllCache();
        
        $response = $this->apiService->API->tasktype_create($fields);
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
        
        $response = $this->apiService->API->tasktype_delete($id);
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
                'field' => $this->lowercaseClassName.'.id',
                'operator' => FiltersOperatorEnum::GREATEREQUALS,
                'value' => 1,
            ],
        ];

        $batchresponse = $this->apiService->API->tasktype_get($filters, $options);
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

        $response = $this->apiService->API->tasktype_getone($filters, $options);
        if ($response[0]['result']['count'] === 1) {
            return $response[0]['result']['rows'][0];
        }

        return null;
    }

    private function invalidateAllCache():  void
    {
        $cacheKey = sprintf('gripp_'.$this->lowercaseClassName.'_%s', md5($this->lowercaseClassName));
        $this->cacheService->deleteCacheByKey($cacheKey);
    }
    
    private function invalidateCache(int $id): void
    {
        $cacheKey = sprintf('gripp_'.$this->lowercaseClassName.'_%s', md5((string) $id));
        $this->cacheService->deleteCacheByKey($cacheKey);
    }

    
    private function saveToCache(array $response): void
    {
        $cacheKey = sprintf('gripp_'.$this->lowercaseClassName.'_%s', md5((string) $response['id']));
        $this->cacheService->saveToCache($cacheKey, $response);
    }

    private function update(int $id, array $fields): bool
    {
        //$entityName = str_replace('Service', '', $this->name());
        //$entityFunction = $this->entityName.'_update';

        $this->invalidateCache($id);
        $this->invalidateAllCache();
        
        //$response = $this->API->$entityFunction($id, $fields);
        $response = $this->apiService->API->tasktype_update($id, $fields);
        if (isset($response[0]['result']['success']) && $response[0]['result']['success']) {
            return true;
        } else {
            return false;
        }
    }
}

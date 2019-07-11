<?php

namespace App\Service;

use App\Entity\Taakfase;
use App\Enum\API\FiltersOperatorEnum;
use App\Enum\API\OptionsOrderingsDirectionEnum;
use App\Form\Data\TaakfaseData;
use App\Repository\TaakfaseRepository;
use App\Service\CacheService;

class TaakfaseService
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
     * @var TaakfaseRepository
     */
    private $taakfaseRepository;
    
    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService,
        TaakfaseRepository $taakfaseRepository
    ) {
        $this->cacheService = $cacheService;
        $this->apiService = $apiService;
        $this->sqlService = $sqlService;
        $this->taakfaseRepository = $taakfaseRepository;
    }

    public function allTaakfases(): array
    {
        $cacheKey = sprintf('gripp_taakfases_%s', md5('taakfases'));
        $hit = $this->cacheService->getFromCache($cacheKey);
        if (false === $hit) {
            $this->sqlService->truncate('App\Entity\Taakfase');
            
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
                            'field' => 'taskphase.id',
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
                $taakfase = $this->denormalizeArrayToTaakfase($response);
                $this->taakfaseRepository->add($taakfase);
            }
            $this->sqlService->getEntityManager()->flush();
            
            return $totalResponse;
        }

        return $hit;
    }

    public function getTaakfaseByIdAsArray(int $id): ?array
    {
        $filters = [
            [
                'field' => Taakfase::API_NAME.'.id',
                'operator' => FiltersOperatorEnum::EQUALS,
                'value' => $id,
            ],
        ];
        $response = $this->getone($filters, [], $id);

        return $response;
    }
    
    public function denormalizeArrayToTaakfase(array $data): ?Taakfase
    {
        $data = array_filter($data, function($var){return !is_null($var);});
        $taakfaseCreatedon = $this->apiService->dateTimeSerializer->denormalize($data['createdon'], \DateTime::class);
        unset($data['createdon']);
        if (isset($data['updatedon'])) {
            $taakfaseUpdatedon = $this->apiService->dateTimeSerializer->denormalize($data['updatedon'], \DateTime::class);
            unset($data['updatedon']);
        }
        $taakfase = $this->apiService->serializer->denormalize($data, Taakfase::class);
        $taakfase->setCreatedon($taakfaseCreatedon);
        if (isset($taakfaseUpdatedon)) {
            $taakfase->setUpdatedon($taakfaseUpdatedon);
        }
        
        return $taakfase;
    }
    
    public function getTaakfaseById(int $id): ?Taakfase
    {
        $response = $this->getTaakfaseByIdAsArray($id);
        if ($response) {
            return $this->denormalizeArrayToTaakfase($response);
        }
        return null;
    }
    
    public function deleteTaakfase(Taakfase $taakfase): void
    {
        $id = $taakfase->getId();
        $this->delete($id);
    }

    /*
        public function addTaakfase(TaakfaseData $taakfaseData)
        {
            $taakfase = new Taakfase();
            $taakfase->setContent($taakfaseData->content);

            $this->createTaakfase($taakfase);
        }
    */
    
    public function createTaakfase(TaakfaseData $taakfaseData): void
    {
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($taakfaseData, null); //, ['groups' => 'write']);
        $this->create($fields);
    }

    public function updateTaakfaseWithData(Taakfase $taakfase, TaakfaseData $taakfaseData): void
    {
        $id = $taakfase->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($taakfaseData, null); //, ['groups' => 'write']);
        $this->update($id, $fields);
    }
    
    public function updateTaakfase(Taakfase $taakfase): void
    {
        $id = $taakfase->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($taakfase, null); //, ['groups' => 'write']);
        unset($fields['id']);
        unset($fields['createdon']);
        unset($fields['updatedon']);
        unset($fields['searchname']);
        $this->update($id, $fields);
    }
    
    private function create(array $fields): bool
    {
        $this->invalidateAllCache();
        
        $response = $this->apiService->API->taskphase_create($fields);
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
        
        $response = $this->apiService->API->taskphase_delete($id);
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
                'field' => Taakfase::API_NAME.'.id',
                'operator' => FiltersOperatorEnum::GREATEREQUALS,
                'value' => 1,
            ],
        ];

        $batchresponse = $this->apiService->API->taskphase_get($filters, $options);
        $response = $batchresponse[0]['result'];

        return $response;
    }

    private function getone(array $filters = [], array $options = [], int $id = 1): ?array
    {
        $filters = [
            [
                'field' => Taakfase::API_NAME.'.id',
                'operator' => FiltersOperatorEnum::EQUALS,
                'value' => $id,
            ],
        ];

        $response = $this->apiService->API->taskphase_getone($filters, $options);
        if ($response[0]['result']['count'] === 1) {
            return $response[0]['result']['rows'][0];
        }

        return null;
    }

    private function invalidateAllCache():  void
    {
        $cacheKey = sprintf('gripp_taakfases_%s', md5('taakfases'));
        $this->cacheService->deleteCacheByKey($cacheKey);
    }
    
    private function invalidateCache(int $id): void
    {
        $cacheKey = sprintf('gripp_'.Taakfase::API_NAME.'_%s', md5((string) $id));
//        $cacheKey = sprintf('gripp_'.$entityName::API_NAME.'_%s', md5((string) $id));
        $this->cacheService->deleteCacheByKey($cacheKey);
    }

    
    private function saveToCache(array $response): void
    {
        $cacheKey = sprintf('gripp_'.Taakfase::API_NAME.'_%s', md5((string) $response['id']));
        $this->cacheService->saveToCache($cacheKey, $response);
    }

    private function update(int $id, array $fields): bool
    {
        //$entityName = str_replace('Service', '', $this->name());
        //$entityFunction = $this->entityName.'_update';

        $this->invalidateCache($id);
        $this->invalidateAllCache();
        
        //$response = $this->API->$entityFunction($id, $fields);
        $response = $this->apiService->API->taskphase_update($id, $fields);
        if (isset($response[0]['result']['success']) && $response[0]['result']['success']) {
            return true;
        } else {
            return false;
        }
    }
}

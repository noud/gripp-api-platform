<?php

namespace App\Service;

use App\Entity\Taakfase;
use App\Form\Data\TaakfaseData;
use App\Repository\TaakfaseRepository;

class TaakfaseService extends AbstractService
{  
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
        parent::__construct($cacheService,$apiService,$sqlService);
        $this->tagRepository = $taakfaseRepository;
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

<?php

namespace App\Service;

use App\Entity\Taskphase;
use App\Form\Data\TaskphaseData;
use App\Repository\TaskphaseRepository;

class TaskphaseService extends AbstractService
{  
    /**
     * @var TaskphaseRepository
     */
    private $taskphaseRepository;
    
    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService,
        TaskphaseRepository $taskphaseRepository
    ) {
        parent::__construct($cacheService,$apiService,$sqlService);
        $this->tagRepository = $taskphaseRepository;
    }
    
    public function deleteTaskphase(Taskphase $taskphase): void
    {
        $id = $taskphase->getId();
        $this->delete($id);
    }

    /*
        public function addTaskphase(TaskphaseData $taskphaseData)
        {
            $taskphase = new Taskphase();
            $taskphase->setContent($taskphaseData->content);

            $this->createTaskphase($taskphase);
        }
    */
    
    public function createTaskphase(TaskphaseData $taskphaseData): void
    {
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($taskphaseData, null); //, ['groups' => 'write']);
        $this->create($fields);
    }

    public function updateTaskphaseWithData(Taskphase $taskphase, TaskphaseData $taskphaseData): void
    {
        $id = $taskphase->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($taskphaseData, null); //, ['groups' => 'write']);
        $this->update($id, $fields);
    }
    
    public function updateTaskphase(Taskphase $taskphase): void
    {
        $id = $taskphase->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($taskphase, null); //, ['groups' => 'write']);
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

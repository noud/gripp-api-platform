<?php

namespace App\Service;

use App\Entity\Tasktype;
use App\Repository\TasktypeRepository;

class TasktypeService extends AbstractService
{    
    /**
     * @var TasktypeRepository
     */
    private $tasktypRepository;
    
    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService,
        TasktypeRepository $tasktypRepository
    ) {
        parent::__construct($cacheService,$apiService,$sqlService);
        $this->tagRepository = $tasktypRepository;
    }
    
    public function deleteTasktype(Tasktype $tasktype): void
    {
        $id = $tasktype->getId();
        $this->delete($id);
    }
    
    public function updateTasktype(Tasktype $tasktype): void
    {
        $id = $tasktype->getId();
        /** @var array $fields */
        $fields = $this->apiService->serializer->normalize($tasktype, null); //, ['groups' => 'write']);
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

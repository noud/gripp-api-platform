<?php

namespace App\Service;

use App\Entity\Task;
use App\Repository\CompanyRepository;
use App\Repository\TaskRepository;
use App\Repository\TaskphaseRepository;
use App\Repository\TasktypeRepository;

class TaskService extends AbstractService
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;
    
    /**
     * @var TaskphaseRepository
     */
    private $taskphaseRepository;
    
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService,
        TaskRepository $taskRepository,
        TaskphaseRepository $taskphaseRepository,
        TasktypeRepository $tasktypeRepository,
        CompanyRepository $companyRepository
    ) {
        parent::__construct($cacheService,$apiService,$sqlService);
        $this->taskRepository = $taskRepository;
        $this->taskphaseRepository = $taskphaseRepository;
        $this->tasktypeRepository = $tasktypeRepository;
        $this->companyRepository = $companyRepository;
    }
    
    public function add(Task $task)
    {
        $this->taskRepository->add($task);
    }
        
    /**
     * @return object
     */
    public function denormalizeArrayToEntity(array $data)
    {
        $data = array_filter($data, function($var){return !is_null($var);});
        
        if (isset($data['deadlinedate'])) {
            $deadlinedate = $this->apiService->dateTimeSerializer->denormalize($data['deadlinedate'], \DateTime::class);
            $deadlinedate = null;
            unset($data['deadlinedate']);
        }
        if (isset($data['type'])) {
            $data['type'] = $this->tasktypeRepository->find($data['type']['id']);
        }
        if (isset($data['phase'])) {
            $data['phase'] = $this->taskphaseRepository->find($data['phase']['id']);
        }
        if (isset($data['company'])) {
            $data['company'] = $this->companyRepository->find($data['company']['id']);
        }
        if (isset($data['offerprojectline'])) {
            //$data['offerprojectline'] = $this->onderdeelRepository->find($data['offerprojectline']['id']);
            $data['offerprojectline'] = null;
        }
        unset($data['offerprojectbase']);   // @TODO check relations
        unset($data['files']);
        unset($data['calendaritems']);
        
        $entity = parent::denormalizeArrayToEntity($data);
        
        if (isset($deadlinedate)) {
            $entity->setDeadlinedate($deadlinedate);
        }
        
        return $entity;
    }
}

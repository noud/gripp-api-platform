<?php

namespace App\Service;

use App\Entity\Taak;
use App\Repository\BedrijfRepository;
use App\Repository\TaakRepository;
use App\Repository\TaakfaseRepository;
use App\Repository\TaaktypeRepository;

class TaakService extends AbstractService
{
    /**
     * @var TaakRepository
     */
    private $taakRepository;
    
    /**
     * @var TaakfaseRepository
     */
    private $taakfaseRepository;
    
    /**
     * @var BedrijfRepository
     */
    private $bedrijfRepository;

    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService,
        TaakRepository $taakRepository,
        TaakfaseRepository $taakfaseRepository,
        TaaktypeRepository $taaktypeRepository,
        BedrijfRepository $bedrijfRepository
    ) {
        parent::__construct($cacheService,$apiService,$sqlService);
        $this->taakRepository = $taakRepository;
        $this->taakfaseRepository = $taakfaseRepository;
        $this->taaktypeRepository = $taaktypeRepository;
        $this->bedrijfRepository = $bedrijfRepository;
    }
    
    public function add(Taak $taak)
    {
        $this->taakRepository->add($taak);
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
            $data['type'] = $this->taaktypeRepository->find($data['type']['id']);
        }
        if (isset($data['phase'])) {
            $data['phase'] = $this->taakfaseRepository->find($data['phase']['id']);
        }
        if (isset($data['company'])) {
            $data['company'] = $this->bedrijfRepository->find($data['company']['id']);
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

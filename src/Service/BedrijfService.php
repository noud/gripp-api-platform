<?php

namespace App\Service;

use App\Entity\Bedrijf;
use App\Repository\BedrijfRepository;

class BedrijfService extends AbstractService
{
    /**
     * @var BedrijfRepository
     */
    private $bedrijfRepository;
    
    public function __construct(
        CacheService $cacheService,
        APIService $apiService,
        SQLService $sqlService,
        BedrijfRepository $bedrijfRepository
    ) {
        parent::__construct($cacheService,$apiService,$sqlService);
        $this->bedrijfRepository = $bedrijfRepository;
    }
    
    public function add(Bedrijf $bedrijf)
    {
        $this->bedrijfRepository->add($bedrijf);
    }
        
    /**
     * @return object
     */
    public function denormalizeArrayToEntity(array $data)
    {
        $data = array_filter($data, function($var){return !is_null($var);});
        
        if (isset($data['foundationdate'])) {
            $foundationdate = $this->apiService->dateTimeSerializer->denormalize($data['foundationdate'], \DateTime::class);
            $foundationdate = null;
            unset($data['foundationdate']);
        }
        unset($data['identity']);
        unset($data['vat']);
        unset($data['tags']);
        unset($data['companyroles']);
        unset($data['files']);
        unset($data['accountmanager']);
        switch ($data['invoicesendto']["searchname"]) {
            case "Gelijk aan bezoekadres":
                $data['invoicesendto'] = 'VISITINGADDRESS';
                break;
            case "Gelijk aan postadres":
                $data['invoicesendto'] = 'POSTADDRESS';
                break;
        }
        switch ($data['invoicesendby']["searchname"]) {
            case "Post":
                $data['invoicesendby'] = 'POST';
                break;
            case "E-mail":
                $data['invoicesendby'] = 'EMAIL';
                break;
        }
        switch ($data['postaddress']["searchname"]) {
            case "Gelijk aan bezoekadres":
                $data['postaddress'] = 'VISITINGADDRESS';
                break;
            case "Anders...":
                $data['postaddress'] = 'OTHER';
                break;
        }
        switch ($data['relationtype']["searchname"]) {
            case "Bedrijf":
                $data['relationtype'] = 'COMPANY';
                break;
            case "Particulier":
                $data['relationtype'] = 'PRIVATEPERSON';
                break;
        }
        if (isset($data['salutation'])) {
            dump($data['salutation']["searchname"]);
            switch ($data['salutation']["searchname"]) {
                case "De heer":
                    $data['salutation'] = 'SIR';
                    break;
                case "":
                    $data['salutation'] = 'MADAM';
                    break;
                case "":
                    $data['salutation'] = 'SIRMADAM';
                    break;
            }
        }
        switch ($data['paymentmethod']["searchname"]) {
            case "Overboeking":
                $data['paymentmethod'] = 'MANUALTRANSFER';
                break;
            case "Automatische incasso":
                $data['paymentmethod'] = 'AUTOMATICTRANSFER';
                break;
        }
        switch ($data['paymentmethod_purchaseinvoice']["searchname"]) {
            case "Overboeking":
                $data['paymentmethod_purchaseinvoice'] = 'MANUALTRANSFER';
                break;
            case "Automatische incasso":
                $data['paymentmethod'] = 'AUTOMATICTRANSFER';
                break;
        }
        
        $entity = parent::denormalizeArrayToEntity($data);
        
        if (isset($foundationdate)) {
            $entity->setFoundationdate($foundationdate);
        }
        
        return $entity;
    }
}

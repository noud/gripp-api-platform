<?php

namespace App\Exporter\Writer;

use App\Service\CurlService as Curl;
use JeroenDesloovere\VCard\VCard;
use Sonata\Exporter\Writer\TypedWriterInterface;

class VcardWriter implements TypedWriterInterface
{
    /** @var array */
    private $vcardObject = [];

    /** @var string */
    private $filename;
    
    /** @var int */
    protected $position;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->position = 2;
    }
    
    public function getDefaultMimeType(): string
    {
        return 'text/x-vcard';
    }

    public function getFormat(): string
    {
        return 'vcf';
    }

    /**
     * {@inheritdoc}
     */
    public function open()
    {}

    /**
     * {@inheritdoc}
     */
    public function write(array $data)
    {
        if ($data['Actief']) {
            $this->vcardObject[$this->position] = new VCard();

            if (isset($data['website'])) {
                $this->vcardObject[$this->position]->addURL($data['website'],'WORK');
            }
            if (isset($data['visitingaddressStreet'])) {
                $this->vcardObject[$this->position]->addAddress(
                    '',
                    '',
                    $data['visitingaddressStreet'].' '.$data['visitingaddressStreetnumber'],
                    $data['visitingaddressCity'],
                    '',
                    $data['visitingaddressZipcode'],
                    $data['visitingaddressCountry'],
                    ('PRIVATEPERSON' === $data['relationtype']) ? 'HOME;POSTAL' : 'WORK'
                );
            }
            if (isset($data['postaddressStreet'])) {
                $this->vcardObject[$this->position]->addAddress(
                    '',
                    '',
                    $data['postaddressStreet'].' '.$data['postaddressStreetnumber'],
                    $data['postaddressCity'],
                    '',
                    $data['postaddressZipcode'],
                    $data['postaddressCountry'],
                    'POSTAL'
                );
            }
            if (isset($data['E-mail'])) {
                $this->vcardObject[$this->position]->addEmail($data['E-mail'],'PREF;WORK');
            }
            if (!isset($data['relationtype']) ||
                (isset($data['relationtype']) && ('PRIVATEPERSON' === $data['relationtype'])) ||
                (isset($data['relationtype']) && ('COMPANY' === $data['relationtype'] && (isset($data['Voornaam']) || isset($data['Achternaam'])))) ||
                isset($data['showoncompanycard'])) {
                    
                // Company Department
                if (isset($data['Naam']) && $data['Naam']) {
                    $this->vcardObject[$this->position]->addCompany($data['Naam']);
                } elseif (!isset($data['Naam']) && !isset($data['showoncompanycard'])) {
                } else {
                    $JWT = '';
                    $curl = new Curl();
                    $response = $curl->execute('/api/contactpersoons/'.$data['id'], $JWT);
                    if (isset($response['company']) || isset($data['Afdeling'])){
                        $companyUri = $response['company'];
                        $response = $curl->execute($companyUri, $JWT);
                        $companyName = $response['companyname'];
                        $departmentName = (isset($data['Afdeling'])) ? $data['Afdeling'] : '';
                        $this->vcardObject[$this->position]->addCompany($companyName, $departmentName);
                    }
                }
                
                if (isset($data['Functie'])) {
                    $this->vcardObject[$this->position]->addJobtitle($data['Functie']);
                }
                $this->vcardObject[$this->position]->addName(
                    $data['Achternaam'],
                    $data['Voornaam'],
                    $data['Tussenvoegsel']  //,
                    //$data['prefix'],
                    //$data['suffix']
                );
                if (isset($data['Privé e-mailen'])) {
                    $this->vcardObject[$this->position]->addEmail($data['Privé e-mailen'],'HOME');
                }
                if (isset($data['Geboortedatum'])) {
                    $this->vcardObject[$this->position]->addBirthday(date("Y-m-d", strtotime($data['Geboortedatum'])));
                } elseif (isset($data['Oprichtingsdatum'])) {
                    $this->vcardObject[$this->position]->addBirthday(date("Y-m-d", strtotime($data['Oprichtingsdatum'])));
                }
                if (isset($data['Telefoon'])) {
                    $typePhone = 'WORK';
                    if (isset($data['relationtype']) && ('PRIVATEPERSON' === $data['relationtype'])) {
                        $typePhone = 'HOME';
                    }
                    $this->vcardObject[$this->position]->addPhoneNumber($data['Telefoon'],$typePhone);
                }
                if (isset($data['Mobiel'])) {
                    $this->vcardObject[$this->position]->addPhoneNumber($data['Mobiel'],'PREF;CELL');
                }
                if (isset($data['street'])) {
                    $this->vcardObject[$this->position]->addAddress(
                        '',
                        '',
                        $data['street'].' '.$data['streetnumber'],
                        $data['city'],
                        '',
                        $data['zipcode'],
                        (isset($data['Land']) && $data['Land']) ? $data['Land'] : '',
                        'HOME;POSTAL'
                    );
                }
            }
        }

        ++$this->position;
    }

    /**
     * Save file
     */
    public function close()
    {
        $vcardString = '';
        foreach ($this->vcardObject as $vcard) {
            $vcardString .= $vcard->buildVCard();
        }
        file_put_contents($this->filename, $vcardString);
    }

}

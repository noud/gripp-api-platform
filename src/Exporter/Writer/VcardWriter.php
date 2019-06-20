<?php

namespace App\Exporter\Writer;

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
        return 'vcard';
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
        //dump($data);die();
        if ($data['Actief']) {
            $this->vcardObject[$this->position] = new VCard();
            
            if (isset($data['companyname'])) {
                $this->vcardObject[$this->position]->addCompany($data['companyname']);
            }
            if (isset($data['company'])) {
                $this->vcardObject[$this->position]->addCompany($data['company'], $data['department']);
            }
            if (isset($data['website'])) {
                $this->vcardObject[$this->position]->addURL($data['website'],'WORK');
            }
            if (isset($data['visitingaddress_street'])) {
                $this->vcardObject[$this->position]->addAddress(
                    '',
                    '',
                    $data['visitingaddress_street'].' '.$data['visitingaddress_streetnumber'],
                    $data['visitingaddress_city'],
                    '',
                    $data['visitingaddress_zipcode'],
                    $data['visitingaddress_country'],
                    'WORK'
                );
            }
            if (isset($data['postaddress_street'])) {
                $this->vcardObject[$this->position]->addAddress(
                    '',
                    '',
                    $data['postaddress_street'].' '.$data['postaddress_streetnumber'],
                    $data['postaddress_city'],
                    '',
                    $data['postaddress_zipcode'],
                    $data['postaddress_country'],
                    'POSTAL'
                );
            }
            if (!isset($data['company']) || isset($data['showoncompanycard'])) {
        //         if (isset($data[''])) {
        //             $this->vcardObject[$this->position]->addJobtitle($data['']);
        //         }
                $this->vcardObject[$this->position]->addName(
                    $data['lastname'],
                    $data['firstname'] //,
                    //$data['additional'],
                    //$data['prefix'],
                    //$data['suffix']
                );
                if (isset($data['E-mail'])) {
                    $this->vcardObject[$this->position]->addEmail($data['E-mail'],'PREF;WORK');
                }
                if (isset($data['Privé e-mailen'])) {
                    $this->vcardObject[$this->position]->addEmail($data['Privé e-mailen'],'HOME');
                }
                if (isset($data['Geboortedatum'])) {
                    $this->vcardObject[$this->position]->addBirthday($data['Geboortedatum']);
                }
                if (isset($data['Telefoon'])) {
                    $this->vcardObject[$this->position]->addPhoneNumber($data['Telefoon'],'WORK');
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
                        $data['country'],
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

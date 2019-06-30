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
        if ($data['Actief']) {
            $this->vcardObject[$this->position] = new VCard();

            if (isset($data['Naam'])) {
                $this->vcardObject[$this->position]->addCompany($data['Naam']);
            }
            if (isset($data['Website'])) {
                $this->vcardObject[$this->position]->addURL($data['Website'],'WORK');
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
                    ('PRIVATEPERSON' === $data['relationtype']) ? 'HOME:POSTAL' : 'WORK'
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
        //         if (isset($data[''])) {
        //             $this->vcardObject[$this->position]->addJobtitle($data['']);
        //         }
                $this->vcardObject[$this->position]->addName(
                    $data['Achternaam'],
                    $data['Voornaam'] //,
                    //$data['additional'],
                    //$data['prefix'],
                    //$data['suffix']
                );
                if (isset($data['Privé e-mailen'])) {
                    $this->vcardObject[$this->position]->addEmail($data['Privé e-mailen'],'HOME');
                }
                if (isset($data['Geboortedatum'])) {
                    $this->vcardObject[$this->position]->addBirthday(date("Y-m-d", strtotime($data['Geboortedatum'])));
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
                        (isset($data['country']) && $data['country']) ?: '',
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

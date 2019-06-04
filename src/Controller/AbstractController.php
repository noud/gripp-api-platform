<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Component\HttpFoundation\Response;

class AbstractController extends SymfonyAbstractController
{
    protected function entitiesTable(string $entityName, array $entityArray = []): Response
    {
        $entityTitle = sprintf('%s %s', \count($entityArray), $entityName);
        $entityDescription = '@TODO EntityDescription';
        $entityFields = array_keys($entityArray[0]);
        $entityValues = array_map(
            function ($a) {
                $returnArray = [];
                $fields = array_keys($a);
                foreach ($fields as $field) {
                    $returnArray[] = $a[$field];
                }

                return $returnArray;
            },
            $entityArray
        );

        return $this->render(
            'entity/index.html.twig',
            [
                'page' => [
                    'title' => $entityTitle,
                    'content' => $entityDescription,
                ],
                'entities' => [
                    'fields' => $entityFields,
                    'tupels' => $entityValues,
                ],
            ]
        );
    }

    protected function entityView(string $entityName, array $entityArray = []): Response
    {
        $entityTitle = sprintf('%s %s', $entityName, $entityArray['id']);
        $entityDescription = '@TODO EntityDescription';
        $entityArrayAsRows = [];
        foreach ($entityArray as $key => $value) {
            $entityArrayAsRows[] = [$key, $value];
        }

        return $this->render('entity/view.html.twig',
            [
                'page' => [
                    'title' => $entityTitle,
                    'content' => $entityDescription,
                ],
                'entity' => [
                    'fields' => ['field', 'value'],
                    'tupel' => $entityArrayAsRows,
                ],
            ]
        );
    }
}

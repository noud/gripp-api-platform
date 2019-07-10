<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
    public function __construct(
    ) {
        parent::__construct();
    }

    protected function executeStart(OutputInterface $output): void
    {
        $output->writeln('<comment>Start : '.(new \DateTime())->format('d-m-Y G:i:s').' ---</comment>');
    }

    protected function executeStop(OutputInterface $output): void
    {
        $output->writeln('<comment>End : '.(new \DateTime())->format('d-m-Y G:i:s').' ---</comment>');
    }

    protected function entitiesTable(OutputInterface $output, string $entityName, array $entityArray = []): void
    {
        $entityTitle = sprintf('%s %s', \count($entityArray), $entityName);
        $entityFields = array_keys($entityArray[0]);
        $entityValues = array_map(
            function ($a) {
                $returnArray = [];
                $fields = array_keys($a);
                
                foreach ($fields as $field) {
                    if (!is_array($a[$field])) {
                        $returnArray[] = $a[$field];
                    } else {
                        if (isset($a[$field]['date'])) {
                            $returnArray[] = $a[$field]['date'];
                        } else {
                            $returnArray[] = '';
                        }
                    }
                }

                return $returnArray;
            },
            $entityArray
        );
        $table = new Table($output);
        $table
            ->setHeaders([
                [new TableCell($entityTitle, ['colspan' => \count($entityFields)])],
                $entityFields,
            ])
            ->setRows($entityValues)
        ;
        $table->render();
    }

    protected function entityView(OutputInterface $output, string $entityName, array $entityArray = []): void
    {
        $entityTitle = sprintf('%s %s', $entityName, $entityArray['id']);
        $entityArrayAsRows = [];
        foreach ($entityArray as $key => $value) {
            $newValue = '';
            if (!is_array($value)) {
                 $newValue = $value;
            } else {
                if (isset($value['date'])) {
                    $newValue = $value['date'];
                }
            }
            $entityArrayAsRows[] = [$key, $newValue];
        }

        $table = new Table($output);
        $table
            ->setHeaders([
                [new TableCell($entityTitle, ['colspan' => 2])],
                ['field', 'value'],
            ])
            ->setRows($entityArrayAsRows)
        ;
        $table->render();
    }
}

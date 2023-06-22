<?php declare(strict_types=1);

namespace Yireo\ListEntitiesCli\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'debug:entities', description: 'List all entities')]
class ListEntities extends Command
{
    private iterable $entityDefinitions;

    public function __construct(
        iterable $entityDefinitions,
        string $name = null
    ) {
        parent::__construct($name);
        $this->entityDefinitions = $entityDefinitions;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);
        $table->setHeaders([
            'Entity name',
            'Entity definition class',
        ]);

        foreach ($this->entityDefinitions as $entityDefinition) {
            $table->addRow([
                $entityDefinition->getEntityName(),
                $entityDefinition->getClass(),
            ]);
        }

        $table->render();

        return Command::SUCCESS;
    }
}
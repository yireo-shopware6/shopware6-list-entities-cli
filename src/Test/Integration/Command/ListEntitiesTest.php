<?php declare(strict_types=1);

namespace Yireo\ListEntitiesCli\Test\Integration\Command;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Shopware\Core\TestBootstrapper;
use Symfony\Component\Console\Command\LazyCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Yireo\ListEntitiesCli\Command\ListEntities;
use Symfony\Bundle\FrameworkBundle\Console\Application as ConsoleApplication;
use Yireo\ListEntitiesCli\Test\Integration\AbstractTestCase;

class ListEntitiesTest extends AbstractTestCase
{


    public function testListEntitiesExecution()
    {
        $container = $this->getContainer();
        $kernel = $container->get('kernel');
        $this->assertTrue(is_dir($kernel->getProjectDir()));

        $container = $this->getContainer();
        $listEntities = $container->get(ListEntities::class);
        $this->assertInstanceOf(ListEntities::class, $listEntities);

        $consoleApplication = new ConsoleApplication($this->getKernel());
        $command = $consoleApplication->find('debug:entities');
        $this->assertInstanceOf(LazyCommand::class, $command);

        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('TagDefinition', $output);
    }
}
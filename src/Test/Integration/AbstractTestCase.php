<?php declare(strict_types=1);

namespace Yireo\ListEntitiesCli\Test\Integration;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Shopware\Core\TestBootstrapper;

class AbstractTestCase extends TestCase
{
    use IntegrationTestBehaviour;

    protected function setUp(): void
    {
        (new TestBootstrapper())
            //->setPlatformEmbedded(false)
            ->addCallingPlugin()
            ->setForceInstallPlugins(false)
            ->bootstrap();

        parent::setUp();
    }

    public function getName()
    {
        return 'testListEntitiesExecution'; // @todo: Why is this needed?
    }
}
<?php
declare(strict_types=1);

namespace Unit;

use Autoframe\DesignPatterns\Singleton\AfrSingletonInterface;
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/AbstractSingletonTemp.php'); //namespace fix in autoloader in multi path env phpunit
require_once(__DIR__ . '/SingletonTraitTemp.php'); //namespace fix in autoloader in multi path env phpunit
require_once(__DIR__ . '/SingletonTraitImplementsTemp.php'); //namespace fix in autoloader in multi path env phpunit

class SingletonTest extends TestCase
{

    protected function setUp(): void
    {
        AbstractSingletonTemp::tearDown();
        SingletonTraitImplementsTemp::tearDown();
    }

    protected function tearDown(): void
    {
        //cleanup between tests for static
        AbstractSingletonTemp::tearDown();
        SingletonTraitImplementsTemp::tearDown();

    }


    /**
     * @test
     */
    public function mixedTest(): void
    {
        echo __CLASS__ . '->' . __FUNCTION__ . PHP_EOL;

        foreach ([
                     [0, 1, false, AbstractSingletonTemp::class, true],
                     [1, 5, true, AbstractSingletonTemp::class, true],
                     [5, 7, true, AbstractSingletonTemp::class, true],
                     [0, 1, false, SingletonTraitImplementsTemp::class, true],
                     [1, 5, true, SingletonTraitImplementsTemp::class, true],
                     [5, 7, true, SingletonTraitImplementsTemp::class, true],
                     [0, 1, false, SingletonTraitTemp::class, false],
                     [1, 5, true, SingletonTraitTemp::class, false],
                     [5, 7, true, SingletonTraitTemp::class, false]
                 ] as $list) {
            list($iGet, $iSet, $bIsset, $sClass, $bInterfaceInstance) = $list;
            $this->assertSame($bIsset, $sClass::hasInstance(), 'hasInstance');
            $oObj = $sClass::getInstance();
            $this->assertSame(true, $oObj instanceof $sClass, 'getInstance');
            $sInterface = AfrSingletonInterface::class;
            $this->assertSame($bInterfaceInstance, $oObj instanceof $sInterface, 'interface instance');
            $this->assertSame($iGet, $oObj->get(), 'get');
            $this->assertSame($iSet, $oObj->set($iSet), 'set');
            $this->assertSame($iSet, $oObj->get(), 'get===set');
            try {
                $this->assertSame(null, new $sClass(), 'new');
            } catch (\Throwable $oEx) {
                $this->assertSame(null, null, 'new OK');
            }

            try {
                $this->assertSame(null, (clone $oObj), 'clone');
            } catch (\Throwable $oEx) {
                $this->assertSame(null, null, 'clone OK');
            }

            try {
                $this->assertSame(null, unserialize(serialize($oObj)), 'wakeup');
            } catch (\Throwable $oEx) {
                $this->assertSame(null, null, 'wakeup OK');
            }


        }

    }

}
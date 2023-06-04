<?php

namespace Unit;

use Autoframe\DesignPatterns\Singleton\AfrSingletonInterface;
use Autoframe\DesignPatterns\Singleton\AfrSingletonTrait;

class SingletonTraitTemp
{
    use AfrSingletonTrait;

    public int $iData = 0;

    public function get(): int
    {
        return $this->iData;
    }

    public function set(int $iData): int
    {
        return $this->iData = $iData;
    }

    public static function tearDown(): void
    {
        foreach (self::$instances as $key => $oInstance) {
            unset($oInstance);
            unset(self::$instances[$key]);
        }
    }
}
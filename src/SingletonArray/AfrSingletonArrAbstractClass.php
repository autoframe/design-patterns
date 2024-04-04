<?php
declare(strict_types=1);

namespace Autoframe\DesignPatterns\SingletonArray;

use Autoframe\DesignPatterns\ArrayAccess\AfrObjectArrayAccessTrait;
use Autoframe\DesignPatterns\Singleton\AfrSingletonAbstractClass;
use Countable;
use Iterator;
use ArrayAccess;

abstract class AfrSingletonArrAbstractClass extends AfrSingletonAbstractClass implements ArrayAccess, Iterator, Countable
{
    use AfrObjectArrayAccessTrait;
}
<?php

namespace Autoframe\DesignPatterns\ArrayAccess;

use ArrayAccess;
use Countable;
use Iterator;

class AfrObjectArrayAccessClass implements ArrayAccess, Iterator, Countable
{
    use AfrObjectArrayAccessTrait;
}
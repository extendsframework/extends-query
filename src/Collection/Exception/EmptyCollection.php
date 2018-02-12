<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Collection\Exception;

use ExtendsFramework\Query\Collection\CollectionException;
use OutOfRangeException;

class EmptyCollection extends OutOfRangeException implements CollectionException
{
    /**
     * NoResultsInCollection constructor.
     */
    public function __construct()
    {
        parent::__construct('Can not get first result from empty collection.');
    }
}

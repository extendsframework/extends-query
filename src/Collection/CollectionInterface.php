<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Collection;

use Iterator;

interface CollectionInterface extends Iterator
{
    /**
     * Get first result from collection.
     *
     * @return object
     * @throws CollectionException
     */
    public function getFirst(): object;
}

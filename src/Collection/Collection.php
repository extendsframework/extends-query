<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Collection;

use ExtendsFramework\Query\Collection\Exception\EmptyCollection;

class Collection implements CollectionInterface
{
    /**
     * Results.
     *
     * @var array
     */
    protected $results;

    /**
     * Result constructor.
     *
     * @param array $results
     */
    public function __construct(array $results)
    {
        $this->results = array_values($results);
    }

    /**
     * @inheritDoc
     */
    public function getFirst(): object
    {
        if (empty($this->results)) {
            throw new EmptyCollection();
        }

        return $this->results[0];
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return current($this->results);
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        next($this->results);
    }

    /**
     * @inheritDoc
     */
    public function key(): ?int
    {
        return key($this->results);
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->key() !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        reset($this->results);
    }
}

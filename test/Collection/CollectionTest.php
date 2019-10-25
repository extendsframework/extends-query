<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Collection;

use ExtendsFramework\Query\Collection\Exception\EmptyCollection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /**
     * Get first.
     *
     * Test that first result will be returned.
     *
     * @covers \ExtendsFramework\Query\Collection\Collection::__construct()
     * @covers \ExtendsFramework\Query\Collection\Collection::getFirst()
     */
    public function testGetFirst(): void
    {
        $collection = new Collection([
            (object)'foo',
            (object)'bar',
            (object)'baz',
        ]);

        $this->assertEquals((object)'foo', $collection->getFirst());
    }

    /**
     * Get iterator.
     *
     * Test that collection can be iterated and test that first result will be returned.
     *
     * @covers \ExtendsFramework\Query\Collection\Collection::__construct()
     * @covers \ExtendsFramework\Query\Collection\Collection::current()
     * @covers \ExtendsFramework\Query\Collection\Collection::valid()
     * @covers \ExtendsFramework\Query\Collection\Collection::next()
     * @covers \ExtendsFramework\Query\Collection\Collection::rewind()
     * @covers \ExtendsFramework\Query\Collection\Collection::key()
     */
    public function testGetIterator(): void
    {
        $collection = new Collection([
            (object)'foo',
            (object)'bar',
            (object)'baz',
        ]);

        $this->assertEquals([(object)'foo', (object)'bar', (object)'baz'], iterator_to_array($collection));
        $this->assertEquals((object)'foo', $collection->getFirst());
    }

    /**
     * Empty collection.
     *
     * Test that an exception will be thrown when first object is retrieved from a empty collection.
     *
     * @covers \ExtendsFramework\Query\Collection\Collection::__construct()
     * @covers \ExtendsFramework\Query\Collection\Collection::getFirst()
     * @covers \ExtendsFramework\Query\Collection\Exception\EmptyCollection::__construct()
     */
    public function testEmptyCollection(): void
    {
        $this->expectException(EmptyCollection::class);
        $this->expectExceptionMessage('Can not get first result from empty collection.');

        (new Collection([]))->getFirst();
    }
}

<?php
namespace Ciebit\Postman\Package;

use ArrayIterator;
use ArrayObject;
use Ciebit\Postman\Package\Package;
use Countable;
use IteratorAggregate;

class Collection implements Countable, IteratorAggregate
{
    /** @var ArrayObject */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayObject;
    }

    public function add(Package $item): self
    {
        $this->items->append($item);
        return $this;
    }

    public function count(): int
    {
        return $this->items->count();
    }

    public function getArrayObject(): ArrayObject
    {
        return clone $this->items;
    }

    public function getById(string $id): ?Package
    {
        foreach ($this->getIterator() as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }

        return null;
    }

    public function getIterator(): ArrayIterator
    {
        return $this->items->getIterator();
    }
}
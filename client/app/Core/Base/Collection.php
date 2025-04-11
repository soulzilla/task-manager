<?php

namespace App\Core\Base;

class Collection implements \ArrayAccess, \Iterator, \Countable
{
    /** @var array */
    protected array $items = [];

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function current(): mixed
    {
        return current($this->items);
    }

    /**
     * @return void
     */
    public function next(): void
    {
        next($this->items);
    }

    /**
     * @return string|int|null
     */
    public function key(): string|int|null
    {
        return key($this->items);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return key($this->items) !== null;
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        reset($this->items);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->items[$offset] = $value;
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    public function append($item): void
    {
        $this->items[] = $item;
    }

    public function prepend($item): void
    {
        array_unshift($this->items, $item);
    }

    public function first()
    {
        return reset($this->items);
    }

    public function last()
    {
        return end($this->items);
    }

    public function remove($item): void
    {
        $key = array_search($item, $this->items, true);
        if ($key !== false) {
            unset($this->items[$key]);
        }
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function take(int $limit): void
    {
        $items = array_chunk($this->items, $limit);

        $this->items = array_shift($items);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}

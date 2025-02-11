<?php

declare(strict_types=1);

namespace InsideData\Support;

use Iterator;
use ArrayAccess;

class TypedCollection implements ArrayAccess, Iterator {

    private $items = [];
    private $accepts;

    private $key = 0;

    public static function accepts(string|array $accepts): TypedCollection {

        $self = new self;
        $self->accepts = $accepts;

        return $self;
    }

    public function current(): mixed {
        return $this->items[$this->key];
    }

    public function next(): void {
        $this->key++;
    }

    public function key(): mixed {
        return $this->key;
    }

    public function valid(): bool {
        return isset($this->items[$this->key]);
    }

    public function rewind(): void {
        $this->key = 0;
    }

    public function offsetExists($offset): bool {

        return isset($this->items[$offset]);
    }

    public function offsetGet($offset): mixed {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value): void {

        $this->add($value, $offset);
    }

    public function offsetUnset($offset): void {
        unset($this->items[$offset]);
    }

    public function add($item, $offset = null): void {

        if (!\is_object($item)) {
            throw new \InvalidArgumentException('Invalid item type for typed collection. Accepts ' . $this->accepts . ' but got ' . gettype($item));
        }

        if (!empty($this->accepts) && !is_a($item, $this->accepts)) {
            throw new \InvalidArgumentException('Invalid item type for typed collection. Accepts ' . $this->accepts . ' but got ' . get_class($item));
        }

        if ($offset !== null) {
            $this->items[$offset] = $item;
            return;
        }

        $this->items[] = $item;
    }

    public function foreach(callable $callback) {
        foreach ($this->items as $item) {
            $callback($item);
        }
    }

    public function __toArray(): array {
        return $this->items;
    }
}

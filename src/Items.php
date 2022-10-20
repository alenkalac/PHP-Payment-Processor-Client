<?php
namespace SymfonyPayments;

class Items {
    /** @var array */
    private $items = [];

    public function add(Item $item) {
        $this->items[] = $item->getItemArray();
    }

    public function getItems(): array {
        return $this->items;
    }
}

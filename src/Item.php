<?php
namespace SymfonyPayments;

class Item {
    private $name;
    private $description;
    private $quantity = 1;
    private $unitAmount;

    public function __construct($name, $unitAmount, $quantity = 1, $description = "") {
        $this->name = $name;
        $this->unitAmount = $unitAmount;
        $this->quantity = $quantity;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getUnitAmount() {
        return $this->unitAmount;
    }

    public function getItemArray(): array {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "unit_amount" => $this->unitAmount,
        ];
    }

}

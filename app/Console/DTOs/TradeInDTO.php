<?php

namespace App\Console\DTOs;

class TradeInDTO
{
    protected string $id;
    protected int $productId;
    protected string $warehouseId;
    protected string $region;
    protected int $price;

    protected ?string $comment;
    protected ?string $reason;
    protected ?string $condition;

    /**
     * @param \SimpleXMLElement $element
     */
    public function __construct(\SimpleXMLElement $element)
    {
        $this->id = $element->СерийныйНомер;
        $this->productId = (int) $element->КодТовара;
        $this->warehouseId = $element->Склад;
        $this->region = $element->Регион;
        $this->price = (int) $element->Цена;
        $this->comment = $element->КомментарийИнженера;
        $this->condition = $element->Состояние;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getWarehouseId(): string
    {
        return $this->warehouseId;
    }

    /**
     * @param string $warehouseId
     */
    public function setWarehouseId(string $warehouseId): void
    {
        $this->warehouseId = $warehouseId;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     */
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @param string|null $reason
     */
    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * @return string|null
     */
    public function getCondition(): ?string
    {
        return $this->condition;
    }

    /**
     * @param string|null $condition
     */
    public function setCondition(?string $condition): void
    {
        $this->condition = $condition;
    }


}

<?php

namespace App\Console\DTOs;

class MarkdownDTO
{
    protected string $id;
    protected int $productId;
    protected string $warehouseId;
    protected string $region;
    protected int $price;

    protected ?string $reason;
    protected ?string $condition;

    protected string $warrantyExpireDate;
    protected string $performance;
    protected string $kit;

    /**
     * @param \SimpleXMLElement $XMLElement
     */
    public function __construct(\SimpleXMLElement $XMLElement)
    {
        $this->setId($XMLElement->СерийныйНомер);
        $this->setProductId((int)$XMLElement->КодТовара);
        $this->setWarehouseId($XMLElement->Склад);
        $this->setRegion($XMLElement->Регион);
        $this->setPrice((int)$XMLElement->Цена);
        $this->setReason($XMLElement->ПричинаУценкиРазвернуто);
        $this->setCondition($XMLElement->Состояние);
        $this->setWarrantyExpireDate($XMLElement->ДатаОкончанияГарантии);
        $this->setPerformance($XMLElement->Работоспособность);
        $this->setKit($XMLElement->Комплект);
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

    /**
     * @return string
     */
    public function getWarrantyExpireDate(): string
    {
        return $this->warrantyExpireDate;
    }

    /**
     * @param string $warrantyExpireDate
     */
    public function setWarrantyExpireDate(string $warrantyExpireDate): void
    {
        $this->warrantyExpireDate = $warrantyExpireDate;
    }

    /**
     * @return string
     */
    public function getPerformance(): string
    {
        return $this->performance;
    }

    /**
     * @param string $performance
     */
    public function setPerformance(string $performance): void
    {
        $this->performance = $performance;
    }

    /**
     * @return string
     */
    public function getKit(): string
    {
        return $this->kit;
    }

    /**
     * @param string $kit
     */
    public function setKit(string $kit): void
    {
        $this->kit = $kit;
    }


}

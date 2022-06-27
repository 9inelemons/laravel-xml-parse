<?php

namespace App\Services;

use App\Console\DTOs\MarkdownDTO;
use App\Console\DTOs\TradeInDTO;
use App\Models\MarkdownProduct;
use App\Models\Product;
use App\Models\TradeInProduct;
use App\Models\Warehouse;
use Illuminate\Support\Carbon;

class XmlTradeInMarkdownImportService
{
    const TRADE_IN_PRODUCT = 'ТрейдИн';
    const MARKDOWN_PRODUCT = 'Уценка';

    public function processTradeIn(TradeInDTO $dto, Carbon $currentTime)
    {
        Warehouse::updateOrCreate(
            ['id' => $dto->getWarehouseId()],
            ['region' => $dto->getRegion()],
        );

        Product::updateOrCreate(
            ['id' => $dto->getProductId()],
            ['title' => $dto->getProductId()],
        );

        TradeInProduct::updateOrCreate(
            ['id' => $dto->getId()],
            [
                'warehouse_id' => $dto->getWarehouseId(),
                'product_id' => $dto->getProductId(),
                'price' => $dto->getPrice(),
                'comment' => $dto->getComment(),
                'condition' => $dto->getCondition(),
                'updated_at' => $currentTime
            ]
        );
    }

    public function processMarkDown(MarkdownDTO $dto, Carbon $currentTime)
    {
        Warehouse::updateOrCreate(
            ['id' => $dto->getWarehouseId()],
            ['region' => $dto->getRegion()],
        );

        Product::updateOrCreate(
            ['id' => $dto->getProductId()],
            ['title' => $dto->getProductId()],
        );

        MarkdownProduct::updateOrCreate(
            ['id' => $dto->getId()],
            [
                'warehouse_id' => $dto->getWarehouseId(),
                'product_id' => $dto->getProductId(),
                'price' => $dto->getPrice(),
                'reason' => $dto->getReason(),
                'condition' => $dto->getCondition(),
                'performance' => $dto->getPerformance(),
                'warranty_expire_at' => $dto->getWarrantyExpireDate() ? Carbon::createFromFormat('d.m.Y', $dto->getWarrantyExpireDate()) : null,
                'kit' => $dto->getKit(),
                'updated_at' => $currentTime
            ]
        );
    }

    public function deactivateProductsMissingInXml(Carbon $currentDateTime)
    {
        $missingMarkdownProductIds = MarkdownProduct::query()
            ->select('product_id')
            ->whereTime('updated_at', '<', $currentDateTime)
            ->get()
            ->pluck('product_id')
            ->toArray();

        $missingTradeInProductIds = TradeInProduct::query()
            ->select('product_id')
            ->whereTime('updated_at', '<', $currentDateTime)
            ->get()
            ->pluck('product_id')
            ->toArray();

        Product::whereIn('id', array_merge($missingMarkdownProductIds, $missingTradeInProductIds))
            ->update(['active' => false]);
    }
}

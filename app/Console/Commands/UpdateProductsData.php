<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateProductsData extends Command
{
    const ENDPOINT_URL = 'https://stage.api.iport.ru/api/products';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update products data from external API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $productIds = Product::all('id')->pluck('id')->toArray();

        foreach ($productIds as $productId)
        {
            $response = $this->makeRequest($productId);
            if ($response) {
                $this->updateProduct($response, $productId);
                echo $productId;
            }
        }
        return 1;
    }

    private function makeRequest(int $productId)
    {
        $jsonResponse = Http::acceptJson()->get(self::ENDPOINT_URL . "/$productId")->body();
        $response = json_decode($jsonResponse, true);

        if ($response['status'] === 'error') return false;

        return [
            'title' => $response['data']['TITLE'],
            'images' => $response['data']['IMAGES'],
            'price' => $response['data']['PRICE']['VALUE'],
        ];
    }

    private function updateProduct(array $data, int $productId)
    {
        foreach ($data['images'] as $image)
        {
            ProductImage::updateOrCreate(
                [
                    'product_id' => $productId,
                    'url' => $image
                ],
                [
                    'product_id' => $productId,
                    'url' => $image
                ],
            );
        }

        Product::where('id', $productId)
            ->update([
                'active' => true,
                'title' => $data['title'],
                'price' => $data['price'],
            ]);
    }
}

<?php

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markdown_products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignIdFor(Product::class, 'product_id');
            $table->foreignIdFor(Warehouse::class, 'warehouse_id');
            $table->unsignedInteger('price');
            $table->text('reason')
                ->nullable();
            $table->string('condition', 30)
                ->nullable();
            $table->date('warranty_expire_at')
                ->nullable();
            $table->string('performance')
                ->nullable();
            $table->string('kit')
                ->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products');

            $table->foreign('warehouse_id')
                ->references('id')
                ->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('markdown_products');
    }
};

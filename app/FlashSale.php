<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    protected $table = 'flash_sales';

    protected $fillable = [
        'product_id', 'start_time', 'end_time', 'discount', 'harga_discount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateDiscount()
    {
        $product = $this->product;

        if ($product) {
            $discount = $this->discount / 100;
            $harga_discount = $product->harga - ($product->harga * $discount);

            $this->harga_discount = $harga_discount;
            $this->save();
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'productname',
        'slug',
        'cateid',
        'brand_id',
        'price',
        'price_sale',
        'image',
        'quantity',
        'status',
        'sort_order',
        'description',
        'detail',
    ];

    /**
     * Quan hệ với Category (nhiều sản phẩm thuộc 1 danh mục)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'cateid', 'cateid');
    }

    /**
     * Quan hệ với Brand (nhiều sản phẩm thuộc 1 thương hiệu)
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}

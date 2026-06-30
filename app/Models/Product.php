<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'productname',
        'slug',
        'cateid',
        'brand_id',
        'brandid',
        'price',
        'price_sale',
        'pricediscount',
        'image',
        'quantity',
        'status',
        'sort_order',
        'description',
        'detail',
    ];

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'cateid', 'cateid');
    }

    // Cấu hình Quan hệ với Brand
    public function brand()
    {
        // products.brandid = brands.id
        return $this->belongsTo(Brand::class, 'brandid', 'id');
    }

    // Quan hệ với ProductImage (ảnh phụ)
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
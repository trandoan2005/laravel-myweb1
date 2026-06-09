<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Chỉ định tên bảng
    protected $table = 'brands';

    // Các cột cho phép thêm/sửa
    protected $fillable = [
        'brandname',
        'slug',
        'description',
        'image',
        'status',
        'sort_order',
    ];
}
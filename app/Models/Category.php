<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Chỉ định tên bảng
    protected $table = 'categories';

    // Chỉ định khóa chính
    protected $primaryKey = 'cateid';

    // Các cột cho phép thêm/sửa
    protected $fillable = [
        'catename',
        'slug',
        'description',
        'image',
        'status',
        'sort_order',
    ];
}
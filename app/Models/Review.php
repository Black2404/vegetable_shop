<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Các trường có thể được gán giá trị hàng loạt (mass assignment)
    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'
    ];

    // Thiết lập mối quan hệ: Một review thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Thiết lập mối quan hệ: Một review thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

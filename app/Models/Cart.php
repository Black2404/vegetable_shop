<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'id'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    public function cart()
{
    return $this->hasOne(Cart::class);
}


}

<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 

    protected $fillable = ['name', 'email', 'password', 'address', 'role'];

    protected $hidden = ['password', 'remember_token'];

    public function cart() {
        return $this->hasMany(Cart::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}

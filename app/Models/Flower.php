<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;

    protected $fillable = [
        'Price',
        'available_guantity',
        'kind_id',
        'totePrice',
    ];


    public function kind() {

        return $this->belongsTo(KindOfFlower::class , 'id');

    }

    public function orders() {

        return $this->hasMany(Order::class);

    }
}

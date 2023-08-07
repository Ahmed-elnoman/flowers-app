<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KindOfFlower extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'color',
        'country'
    ];

    public function flower() {

        return $this->hasMany(KindOfFlower::class , 'id');

    }
}

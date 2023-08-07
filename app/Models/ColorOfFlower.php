<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorOfFlower extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'hyperlink_to_the_icon'];


    public function flower_color() {
        return $this->belongsTo(Flower::class);
    }
}

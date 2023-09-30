<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class road extends Model
{
    use HasFactory;

    public function category(){

        return $this->belongsTo(category::class);
    }

    public function plots(){

      return  $this->hasMany(plot::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class book extends Model
{
    use HasFactory, SoftDeletes;

 public function category(){

        return $this->belongsTo(category::class);
    }

    public function customers(){

        return $this->hasMany(customer::class);
    }

public function road(){

    return $this->belongsTo(road::class);
}
    protected $table = 'books';

}

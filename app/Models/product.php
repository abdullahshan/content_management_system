<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory, HasTags, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'title', 
        'slug',

    ];  
    public function categories(){

        return $this->belongsToMany(category::class);
    }

    public function user(){

        return $this->belongsTo(user::class);
    }
}

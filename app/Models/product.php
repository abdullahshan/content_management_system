<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory, HasTags, SoftDeletes;

    protected $fillable = [
        'title', 'user_id','content',
    ];
    public function categories(){

        return $this->belongsToMany(category::class);
    }
}

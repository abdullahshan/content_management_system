<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shair extends Model
{
    use HasFactory;

    public function customer(){

        return $this->belongsTo(customer::class);
    }
}

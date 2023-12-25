<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomieenitoshair extends Model
{
    use HasFactory;

    public function shair(){

        return $this->belongsTo(shair::class);
    }

}

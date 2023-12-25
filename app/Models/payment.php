<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    public function payreport()
    {

        return $this->hasMany(report::class);
    }

public function customer(){

    return $this->belongsTo(customer::class);
}
    
}

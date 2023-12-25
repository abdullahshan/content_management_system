<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class customer extends Model
{
    use HasFactory, SoftDeletes;

    public function book()
    {

        return $this->belongsTo(book::class);
    }

    public function shair()
    {

        return $this->hasMany(shair::class);
    }

    public function mominee(){

        return $this->hasMany(mominee::class);
    }


    public function report()
    {

        return $this->hasMany(report::class);
    }

    public function nomieenitoshair(){

        return $this->hasMany(nomieenitoshair::class);
    }

    protected $table = 'customers';

}

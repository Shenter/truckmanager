<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Truck
 * @mixin \Eloquent
 */
class Truck extends Model
{
    use HasFactory;


    protected $fillable=['user_id'];
    protected $hidden = ['id','deleted_at','created_at','updated_at'];

    public function garage()
    {
        return $this->belongsTo(Garage::class)->withDefault(null);
    }
    public function driver()
    {
        return $this->hasOne(Driver::class)->withDefault(null);
    }
}



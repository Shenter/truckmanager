<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['user_id','character_id','truck_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class)->withDefault(null);
    }
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['user_id'];
    protected $hidden = ['id','deleted_at','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault('User for this garage not found (Is garage sold?)');
    }

    public function trucks()
    {
        return $this->hasMany(Truck::class);
    }

    public function freecells()
    {
        return  $this->level - Truck::where(['garage_id'=>$this->id])->count();
    }

}


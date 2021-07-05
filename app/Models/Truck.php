<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Classes\UserHelper;
use Illuminate\Support\Facades\Auth;

/**
 * Class Truck
 * @mixin \Eloquent
 */
class Truck extends Model
{
    use HasFactory;
public $userHelper;

    protected $fillable=['user_id','garage_id','name','type'];
    protected $hidden = ['id','deleted_at','created_at','updated_at','garage_id'];

    public function __construct()
    {
        $this->userHelper =   new UserHelper();
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class)->withDefault(null);
    }
    public function driver()
    {
        return $this->hasOne(Driver::class)->withDefault(null);
    }


    public function improveGarage()
    {
        if($this->level==3)
        {
            if(!$this->userHelper->isEnoughMoneyToUpdateGarage())
            {

            }
        }
    }
}



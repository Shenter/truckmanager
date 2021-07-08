<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $table='work_jobs';
    protected $fillable=['driver_id','cost','ends_at','name','user_id','is_active'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}

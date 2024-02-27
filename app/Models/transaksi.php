<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function user (){
        return $this->belongsTo(user::class);
    }

    function service(){
        return $this->belongsTo(service::class , 'service_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'id','identification','amount','quotas','total','status'
    ];

    public function movements(){
        return $this->hasMany(Movements::class, 'request_id');
    }

}

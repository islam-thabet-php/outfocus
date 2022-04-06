<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'amount'
    ];
    const dt_relations = [
        'user'=>'User',
        'withdrawal'=>'User'
        ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function withdrawal(){
        return $this->belongsTo(User::class,'withdrawal_id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}

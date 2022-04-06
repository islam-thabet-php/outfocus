<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'client_id',
        'title',
        'start_date',
        'end_date',
        'notes'
    ];
    const dt_relations = [
        'user'=>'User',
        'client'=>'Client'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
}

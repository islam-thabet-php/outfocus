<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEquipment extends Model
{
    use HasFactory;

    public function equipment(){
        return $this->belongsTo(Equipment::class,'equipment_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}

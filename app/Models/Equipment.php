<?php

namespace App\Models;

use Bnb\Laravel\Attachments\HasAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory,HasAttachment;
    protected $table = 'equipments';
    protected $fillable = [
        'type_id',
        'name',
        'code',
        'model',
        'price',
    ];
    const dt_relations = [
        'type'=>'Type',
    ];
    public function type(){
        return $this->belongsTo(Type::class,'type_id');
    }
}

<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, UsesUuid;
    protected $fillable = [
        'tag',
        'length',
        'iv',
        'user_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}

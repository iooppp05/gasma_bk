<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name', 'address', 'phone', 'contact', 'contact_phone', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    
}


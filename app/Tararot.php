<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tararot extends Model
{
    protected $table = 'historys';
    
    protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
}

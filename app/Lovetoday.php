<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lovetoday extends Model
{
    protected $table = 'lovetodayinfos';
    
    protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
}

<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier_state extends Model
{

    public function Carrier()
    {
        return $this->belongsTo("Digi\Models\carrier");
    }
    public function State()
    {
    	return $this->hasOne("Digi\Models\state");
    }
    
}
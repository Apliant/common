<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier_tooltip extends Model
{

    public function Carrier()
    {
        return $this->belongsTo("Digi\Models\carrier");
    }
    public function State()
    {
    	return $this->hasOne("Digi\Models\state");
    }
    public function Agency()
    {
    	return $this->belongsTo("Digi\Models\agency");
    }
    public function Author()
    {
    	return $this->hasOne("Digi\Models\agent", 'id', 'author');
    }
    
}
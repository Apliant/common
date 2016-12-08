<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class agent_carrier_state extends Model
{
     public function Agent()
    {
    	return $this->belongsTo('Digi\Models\agent');
    }
    public function Carrier()
    {
    	return $this->hasOne('Digi\Models\carrier');
    }
    public function State()
    {
    	return $this->hasOne('Digi\Models\state');
    }
}

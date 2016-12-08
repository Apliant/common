<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class agency_carrier_state extends Model
{
    public function Agency()
    {
    	return $this->belongsTo('Digi\Models\agency');
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

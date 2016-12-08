<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier_product extends Model
{
    public function Carrier()
    {
    	return $this->belongsTo("Digi\Models\carrier");
    }
}

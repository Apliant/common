<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier_exclusion_group extends Model
{

    public function Type()
    {
    	return $this->hasOne('Digi\Models\carrier_exclusion_type', 'id', 'exclusion_type_id');
    }
    public function Agent()
    {
        return $this->belongsTo("Digi\Models\agent");
    }
    public function Exclusions()
    {
        return $this->hasMany("Digi\Models\carrier_exclusion", 'exclusion_group_id', 'id');
    }
    
}
<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier_exclusion_type extends Model
{

    public function Groups()
    {
        return $this->hasMany("Digi\Models\carrier_exclusion_group", 'exclusion_type_id', 'id');
    }
    
}
<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier_exclusion extends Model
{

    public function Carrier()
    {
    	return $this->hasOne('Digi\Models\carrier');
    }
    public function Group()
    {
        return $this->hasOne("Digi\Models\carrier_exclusion_group", 'id', 'exclusion_group_id');
    }
    public function Enumeration()
    {
        return $this->hasOne('Digi\Models\enumeration');
    }
}
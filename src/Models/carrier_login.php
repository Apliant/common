<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class carrier_login extends Model
{

    public function Carrier()
    {
        return $this->belongsTo("Digi\Models\carrier", 'ezlynx_id', 'ezlynx_id');
    }
    public function State()
    {
    	return $this->hasOne("Digi\Models\state");
    }
    public function Agent()
    {
    	return $this->belongsTo("Digi\Models\agent");
    }
    public function Parent()
    {
    	return $this->belongsTo("Digi\Models\carrier_login", 'id', 'parent_id');
    }
    
}
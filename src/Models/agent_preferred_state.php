<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class agent_preferred_state extends Model
{
    public function Agent()
    {
    	return $this->belongsTo('Digi\Models\agent');
    }
    public function State()
    {
    	return $this->hasOne('Digi\Models\state');
    }
}

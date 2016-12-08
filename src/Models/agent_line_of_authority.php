<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class agent_line_of_authority extends Model
{
     public function License()
    {
    	return $this->belongsTo('Digi\Models\agent_license');
    }
    public function Line()
    {
    	return $this->hasOne('Digi\Models\enumeration');
    }
}

<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class callbacks extends Model
{
    

    public function Lead()
    {
    	return $this->belongsTo("Digi\Models\lead");
    }

  
}

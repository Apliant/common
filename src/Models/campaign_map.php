<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class campaign_map extends Model
{
    

    public function Agency()
    {
    	return $this->belongsTo("Digi\Models\agency");
    }
    public function Agent()
    {
    	return $this->belongsTo("Digi\Models\agent");
    }
    public function Campaign(){
    	return $this->hasOne("Digi\Models\campaign");
    }
  
}

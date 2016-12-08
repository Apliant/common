<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class dynamic_content extends Model
{

    public function Type()
    {
        return $this->hasOne("Digi\Models\enumeration", 'id', 'type');
    }
    public function AttrOne()
    {
    	return $this->hasOne("Digi\Models\enumeration", "id", "attr_one");
    }
    public function AttrTwo()
    {
    	return $this->hasOne("Digi\Models\enumeration", "id", "attr_two");
    }
    public function Author()
    {
    	return $this->belongsTo("Digi\Models\agent", "id", "author");
    }
    
}
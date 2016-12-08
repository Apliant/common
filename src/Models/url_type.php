<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class url_type extends Model
{
    public function Contacts()
    {
    	return $this->hasMany("Digi\Models\contact", "url_type");
    }
}

<?php

namespace Digi\Models;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    public function Contacts()
    {
    	return $this->hasMany("Digi\Models\contact", "country");
    }
}
